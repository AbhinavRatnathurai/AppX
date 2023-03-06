import unittest

from model import preprocess

class TestPreprocess(unittest.TestCase):
    
    def test_preprocess(self):
        text = "Hello! This is a sample text with numbers 123 and special characters @$%."
        expected_output = "hello. this is a sample text with numbers and special characters."
        self.assertEqual(preprocess(text), expected_output)
        
    def test_preprocess_with_empty_string(self):
        text = ""
        expected_output = ""
        self.assertEqual(preprocess(text), expected_output)
        
    def test_preprocess_with_only_special_characters(self):
        text = "@$%!"
        expected_output = ""
        self.assertEqual(preprocess(text), expected_output)
        
    def test_preprocess_with_only_numbers(self):
        text = "123456"
        expected_output = ""
        self.assertEqual(preprocess(text), expected_output)
        
    def test_preprocess_with_multiple_spaces(self):
        text = "    hello   world     !"
        expected_output = "hello. world."
        self.assertEqual(preprocess(text), expected_output)
        
    def test_preprocess_with_newline_characters(self):
        text = "Hello!\nThis is a sample text.\nWith newline characters."
        expected_output = "hello. this is a sample text. with newline characters."
        self.assertEqual(preprocess(text), expected_output)



class TestCalculateStarRating(unittest.TestCase):
    
    def test_calculate_star_rating(self):
        comm_db = "This product is amazing. I love it!"
        expected_result = {"positive": 2, "negative": 0}
        
        # import the function to be tested
        from test_model import calculate_star_rating
        
        # call the function with the test input
        result = calculate_star_rating(comm_db)
        
        # assert that the result matches the expected output
        self.assertEqual(result, expected_result)



if __name__ == '__main__':
    unittest.main()



