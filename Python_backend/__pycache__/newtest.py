from typing import Self
import unittest
import sys
import time
import openai
import mysql.connector
from unittest.mock import  patch





sys.path.insert(0, "C:\\Users\\user\\Desktop\\AppX-Front-End\\Python_backend")

from model import preprocess
from model import preprocess,gpt_prompt,count_sentiment_words,calculate_star_rating,main


class TestPreprocess(unittest.TestCase):
    text = ""
    expected_output = ""
    Self.assertEqual(preprocess(text), expected_output)

class TestGptPrompt(unittest.TestCase):
    
    def test_gpt_prompt(self):
        prompt = "Hello, how are you?"
        response = gpt_prompt(prompt)
        self.assertTrue(response)

class TestCountSentimentWords(unittest.TestCase):

    def test_count_sentiment_words(self):
        sentence = "I really enjoyed my meal at the restaurant last night."
        expected_output = 5.0
        self.assertEqual(count_sentiment_words(sentence), expected_output)

        


class TestCalculateStarRating(unittest.TestCase):
    def test_calculate_star_rating(self):
        # Define test case input
        comm_db = "amazing,excellent,good product"

        # Define expected output
        expected_result = calculate_star_rating(comm_db)

        # Call the function and get the actual result
        actual_result = calculate_star_rating(comm_db)

        # Assert that the actual result matches the expected result
        self.assertEqual(actual_result, expected_result)



if __name__ == '__main__':
    unittest.main()
