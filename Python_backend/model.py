import openai
import re
import time
import mysql.connector

# Insert your API key here
openai.api_key = "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"

def preprocess(text):
    try:
        # Remove special characters and numbers
        cleaned = re.sub('[^a-zA-Z.,!]', ' ', text)
        cleaned = re.sub(r'\s+', ' ', cleaned)
        # Remove unwanted spaces at the beginning and end of each sentence
        sentences = cleaned.split(".")
        cleaned = ".".join([sentence.strip() for sentence in sentences])
        # Return the cleaned text
        return cleaned.lower()
    except Exception as e:
        print("An error occured:", e)
    

def gpt_prompt(prompt):
    while True:
        try:
            response = openai.Completion.create(
                engine="text-davinci-003",
                prompt=prompt,
                max_tokens=1024,
                n=1,
                stop=None,
                temperature=0.5,
                best_of=1,
                top_p=1,
                frequency_penalty=0,
                presence_penalty=0
            )
            break
        except openai.OpenAIError as e:
            time.sleep(3)
    return response


def count_sentiment_words(sentence):
        
    response = gpt_prompt("Please analyze the following sentence and return only the numerical value of the count of words with positive connotations, including those with implicit positive meanings." + sentence)

    if response:
        positive_count = response["choices"][0]["text"].split("\n")
        positive_count = int(positive_count[2])
    else:
        positive_count = None

    response = gpt_prompt("Please analyze the following sentence and return only the numerical value of the count of words with negative connotations, including those with implicit negative meanings." + sentence)
    
    if response:
        negative_count = response["choices"][0]["text"].split("\n")
        negative_count = int(negative_count[2])
    else:
        negative_count = None

    # Generate the overall sentence rank
    sentence_rank = round(calculate(positive_count, negative_count), 1)

    # Update the database with the calculated star rating
    #mycursor.execute("UPDATE comment SET star_rating = %s WHERE id = %s", (sentence_rank, cId))
    #mydb.commit()

    return sentence_rank


def calculate(positive_count, negative_count):
    try:
        if positive_count + negative_count == 0:
            return 0
        ratio = positive_count / (positive_count + negative_count)
        points = ratio * 5
        return points
    except ZeroDivisionError as e:
        print("Error: Cannot divide by zero.")
    except Exception as e:
        print("Error: ", e)


# Define the function to calculate the star rating for a comment
def calculate_star_rating(comm_db):
    # Send for text pre-processing
    processed = preprocess(comm_db)

    # Retrieve both positive words count and negative words count
    result = count_sentiment_words(processed)
    return result


def main():

    config = {
    'user': 'root',
    'password': '',
    'host': 'localhost',
    'database': 'appx',
    'raise_on_warnings': True,
    'port': '3306'
    }
    try:
        # Connect to the database
        cnx = mysql.connector.connect(**config)

        # Perform some database operations
        cursor = cnx.cursor()
        query = "SELECT comm FROM comment"
        cursor.execute(query)
        for row in cursor:
            print(row)

        # define the product_id variable
        pId = 2 # replace 1234 with the actual product_id

        # Select all comments
        mycursor = cnx.cursor()
        mycursor.execute("SELECT csRate, cId, comm FROM comment")
        
        while True:
            # Fetch the next batch of comments
            results = mycursor.fetchmany(100)
            if not results:
                break

            for result in results:
                cs_rate, c_id, comm = result
                if cs_rate is None:
                    # Calculate the star rating for the comment
                    star_rating = calculate_star_rating(comm)

                    # Update the comment with the star rating
                    cursor = cnx.cursor() # Rename mycursor to cursor
                    query = "UPDATE comment SET csRate = %s WHERE cId = %s"
                    values = (star_rating, c_id)
                    cursor.execute(query, values)
                    cnx.commit()

                    # Print the results
                    print("Comment ID: {}, Star Rating: {}, Comment: {}".format(c_id, star_rating, comm))

            # Pause briefly between batches
            time.sleep(5)

    except mysql.connector.Error as err:
        print(f"Error connecting to the database: {err}")
    except Exception as e:
        print("An error occurred:", e)  

 # Retrieve all the comment ratings from the database
    mycursor = cnx.cursor()
    mycursor.execute("SELECT csRate FROM comment")
    results = mycursor.fetchall()

    tot = 0
    count = 0
    for x in results: 
       if x[0] is not None:
          tot += x[0]
          count += 1

    if count > 0:
       avg = tot / count
       print("Average rating:", avg)

    # Update the product table with the average rating
       mycursor.execute("UPDATE product SET psRate = %s WHERE pId = %s", (avg, 2))
       cnx.commit()
    else:
       print("No ratings found")
         


if __name__ == '__main__':
    main()