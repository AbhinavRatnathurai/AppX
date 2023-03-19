import unittest
import sys

sys.path.insert(0, "C:\\Users\\user\\Desktop\\AppX-Front-End\\Python_backend")

from model import preprocess


class TestPreprocess(unittest.TestCase):

    def test_clean_text(self):
        # Test that the function removes special characters and numbers
        text = "This is a test! 1234 #$%&"
        expected_output = "this is a test!"
        self.assertEqual(preprocess(text), expected_output)

    def test_remove_spaces(self):
        # Test that the function removes unwanted spaces
        text = "   This is a   test.  "
        expected_output = "this is a test."
        self.assertEqual(preprocess(text), expected_output)

    def test_lowercase(self):
        # Test that the function converts text to lowercase
        text = "THIS IS A TEST."
        expected_output = "this is a test."
        self.assertEqual(preprocess(text), expected_output)

    def test_empty_input(self):
        # Test that the function handles empty input
        text = ""
        expected_output = ""
        self.assertEqual(preprocess(text), expected_output)
