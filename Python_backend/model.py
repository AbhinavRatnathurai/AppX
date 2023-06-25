import openai
import re
import time
import mysql.connector


# Insert your API key here
openai.api_key = "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"

def preprocess(text):
    try:
        # Define the stopwords to remove
        stopwords = ['the', 'is', 'are', 'a', 'an', 'and', 'in', 'on', 'to']  # Add more words as needed

        # Convert text to lowercase
        cleaned = text.lower()

        # Remove stopwords
        words = cleaned.split()
        cleaned_words = [word for word in words if word not in stopwords]

        # Join the cleaned words
        cleaned = ' '.join(cleaned_words)

        return cleaned

    except Exception as e:
        print("An error occurred:", e)




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
    try:
        response = gpt_prompt("Please analyze the following sentence and return only the numerical value of the count of words with positive connotations, including those with implicit positive meanings. " + sentence)
        if response:
            positive_count = int(response["choices"][0]["text"].split("\n")[2].replace('&nbsp;', ' '))
        else:
            print("positive")
            positive_count = None

        response = gpt_prompt("Please analyze the following sentence and return only the numerical value of the count of words with negative connotations, including those with implicit negative meanings. " + sentence)
        if response:
            negative_count = int(response["choices"][0]["text"].split("\n")[2].replace('&nbsp;', ' '))
        else:
            print("negative")
            negative_count = None

        # Generate the overall sentence rank
        sentence_rank = round(calculate(positive_count, negative_count), 1)

        # Update the database with the calculated star rating
        # mycursor.execute("UPDATE comment SET star_rating = %s WHERE id = %s", (sentence_rank, cId))
        # mydb.commit()

        return sentence_rank
    except ValueError as e:
        error_message = str(e)
        if "invalid literal for int() with base 10" in error_message:
            print("An error occurred:", error_message)
            print("Retrying...")
            return count_sentiment_words(sentence)  # Retry the execution
        else:
            raise e
    except Exception as e:
        print("An error occurred:", e)


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
        print("Error:", e)

def calculate_star_rating(comm_db):
    try:
        processed = preprocess(comm_db)
        
        result = count_sentiment_words(processed)
        return result
    except Exception as e:
        print("An error occurred:", e)

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
        cnx = mysql.connector.connect(**config)
        cursor = cnx.cursor()
        query = "SELECT comm FROM comment"
        cursor.execute(query)
        for row in cursor:
            print(row)

        pId = 1  # Replace with the actual product_id

        mycursor = cnx.cursor()
        mycursor.execute("SELECT csRate, cId, comm FROM comment")

        while True:
            results = mycursor.fetchmany(100)
            if not results:
                break

            for result in results:
                cs_rate, c_id, comm = result
                if cs_rate is None:
                    original_comment = comm
                    preprocessed_comment = preprocess(comm)
                    print(preprocessed_comment)
                    star_rating = calculate_star_rating(comm)
                    print(star_rating)
                    cursor = cnx.cursor()
                    query = "UPDATE comment SET csRate = %s WHERE cId = %s"
                    values = (star_rating, c_id)
                    cursor.execute(query, values)
                    cnx.commit()
                    print("Comment ID: {}, Star Rating: {}, Comment: {}".format(c_id, star_rating, original_comment))
            time.sleep(5)

    except mysql.connector.Error as err:
        print(f"Error connecting to the database: {err}")
    except Exception as e:
        print("An error occurred:", e)

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

        mycursor.execute("UPDATE product SET psRate = %s WHERE pId = %s", (avg, 1))
        cnx.commit()

    else:
        print("No ratings found")

if __name__ == '__main__':
    main()
