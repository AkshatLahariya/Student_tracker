from flask import Flask, render_template, request, jsonify
import pickle
import numpy as np

app = Flask(__name__)

# Load the trained model
with open('pass_fail_model.pkl', 'rb') as model_file:
    pass_fail_model = pickle.load(model_file)

@app.route('/')
def home():
    return render_template('perf.html')

@app.route('/predict', methods=['POST'])
def predict():
    if request.method == 'POST':
        try:
            # Get user input from the JSON request
            data = request.get_json()
            total_marks = float(data['total_marks'])
            attendance = float(data['attendance'])

            # Create a NumPy array with user input
            user_input = np.array([[total_marks, attendance]])

            # Make prediction
            predicted_pass_fail = pass_fail_model.predict(user_input)[0]

            # Get the probability of pass and fail
            probabilities = pass_fail_model.predict_proba(user_input)[0]
            probability_pass = probabilities[pass_fail_model.classes_ == 'Pass'][0]
            probability_fail = probabilities[pass_fail_model.classes_ == 'Fail'][0]

            # Return the prediction result as JSON
            return jsonify({
                'predicted_pass_fail': predicted_pass_fail,
                'probability_pass': probability_pass,
                'probability_fail': probability_fail
            })

        except Exception as e:
            # Return an error message if there's an exception
            return jsonify({'error': str(e)})

if __name__ == '__main__':
    app.run(debug=True)
