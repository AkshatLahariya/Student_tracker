# flask-app.py

from flask import Flask, jsonify, render_template
import subprocess

app = Flask(__name__)

@app.route('/')
def home():
    return render_template('stu_dashboard.html')

@app.route('/start-app', methods=['GET'])
def start_app():
    # Start the app.py in a separate thread
    subprocess.run(['python', 'app.py'], check=True)
    
    return jsonify({'message': 'app.py is starting...'})

if __name__ == '__main__':
    app.run(debug=True)