import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
import numpy as np
import matplotlib.pyplot as plt
import pickle

# Assuming df is your DataFrame containing the dataset
df = pd.read_csv("AIES-DATA1.csv")

# Add the 'Total_Marks' column
df['Total_Marks'] = df[['Marks_AIES', 'Marks_DEC', 'Marks_FSD', 'Marks_ICS', 'Marks_ITCH']].sum(axis=1)

# Separate features and target variables
features = df[['Total_Marks', 'ATTENDANCE(%)']]
pass_fail_column = 'PASS/FAIL'  # Add a new column for pass/fail

# Set passing threshold
passing_threshold = 250

# Calculate pass/fail column
df[pass_fail_column] = np.where(df['Total_Marks'] >= passing_threshold, 'Pass', 'Fail')

# Train-test split for pass/fail prediction
X_pass_fail = df[['Total_Marks', 'ATTENDANCE(%)']]
y_pass_fail = df[pass_fail_column]
X_train_pass_fail, X_test_pass_fail, y_train_pass_fail, y_test_pass_fail = train_test_split(X_pass_fail, y_pass_fail, test_size=0.2, random_state=42)

# RandomForestClassifier for pass/fail prediction
pass_fail_model = RandomForestClassifier(n_estimators=100, random_state=42)
pass_fail_model.fit(X_train_pass_fail, y_train_pass_fail)

# Save the trained model using pickle
with open('pass_fail_model.pkl', 'wb') as model_file:
    pickle.dump(pass_fail_model, model_file)

# Get user input for prediction
user_input_marks = float(input("Enter total marks: "))
user_input_attendance = float(input("Enter attendance percentage:"))

# Convert user input to a NumPy array
user_input_np = np.array([[user_input_marks, user_input_attendance]])

# Predict pass/fail
predicted_pass_fail = pass_fail_model.predict(user_input_np)[0]
print(f"Predicted Pass/Fail: {predicted_pass_fail}")

# Get the probability of pass and fail
probabilities = pass_fail_model.predict_proba(user_input_np)[0]
probability_pass = probabilities[pass_fail_model.classes_ == 'Pass'][0]
probability_fail = probabilities[pass_fail_model.classes_ == 'Fail'][0]

# Display the probability pie chart with legend
labels = ['Pass', 'Fail']
sizes = [probability_pass, probability_fail]
colors = ['lightgreen', 'lightcoral']

fig, ax = plt.subplots()
explode = (0.1, 0)  # explode the 'Pass' slice for emphasis
ax.pie(sizes, labels=labels, autopct='%1.1f%%', colors=colors, startangle=90, explode=explode)
ax.axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.

# Add legend
ax.legend(labels, loc='upper right')

plt.title('Probability of Pass/Fail')
plt.show()
