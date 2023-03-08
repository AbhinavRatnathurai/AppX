import unittest
import sys
import os

# Get the absolute path of the current directory
current_dir = os.path.abspath(os.path.dirname(__file__))

# Join the current directory with the relative path of the Python backend directory
backend_dir = os.path.join(current_dir, "..", "Python_backend")
sys.path.insert(0, backend_dir)

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
