import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor, RandomForestClassifier
from sklearn.metrics import mean_squared_error, accuracy_score, classification_report
import numpy as np

# Assuming df is your DataFrame containing the dataset
df=pd.DataFrame("AIES-DATA1.csv")
# Separate features and target variables
features = df[['Marks_AIES', 'Marks_DEC', 'Marks_FSD', 'Marks_ICS', 'Marks_ITCH', 'ATTENDANCE(%)']]
marks_columns = ['Marks_AIES', 'Marks_DEC', 'Marks_FSD', 'Marks_ICS', 'Marks_ITCH']
attendance_column = 'ATTENDANCE(%)'
pass_fail_column = 'PASS/FAIL'  # Add a new column for pass/fail

# Calculate total marks and add pass/fail column
df['Total_Marks'] = df[marks_columns].sum(axis=1)
df[pass_fail_column] = np.where(df['Total_Marks'] >= 40, 'Pass', 'Fail')

# Train-test split for marks prediction
X_marks = df[marks_columns]
y_marks = df['Total_Marks']
X_train_marks, X_test_marks, y_train_marks, y_test_marks = train_test_split(X_marks, y_marks, test_size=0.2, random_state=42)

# Train-test split for attendance prediction
X_attendance = df[['Marks_AIES', 'Marks_DEC', 'Marks_FSD', 'Marks_ICS', 'Marks_ITCH', 'Total_Marks']]
y_attendance = df[attendance_column]
X_train_attendance, X_test_attendance, y_train_attendance, y_test_attendance = train_test_split(X_attendance, y_attendance, test_size=0.2, random_state=42)

# Train-test split for pass/fail prediction
X_pass_fail = df[['Marks_AIES', 'Marks_DEC', 'Marks_FSD', 'Marks_ICS', 'Marks_ITCH', 'ATTENDANCE(%)']]
y_pass_fail = df[pass_fail_column]
X_train_pass_fail, X_test_pass_fail, y_train_pass_fail, y_test_pass_fail = train_test_split(X_pass_fail, y_pass_fail, test_size=0.2, random_state=42)

# RandomForestRegressor for marks prediction
marks_model = RandomForestRegressor(n_estimators=100, random_state=42)
marks_model.fit(X_train_marks, y_train_marks)

# RandomForestRegressor for attendance prediction
attendance_model = RandomForestRegressor(n_estimators=100, random_state=42)
attendance_model.fit(X_train_attendance, y_train_attendance)

# RandomForestClassifier for pass/fail prediction
pass_fail_model = RandomForestClassifier(n_estimators=100, random_state=42)
pass_fail_model.fit(X_train_pass_fail, y_train_pass_fail)

# Get user input for prediction
user_input_marks = [float(input(f"Enter marks for {subject}: ")) for subject in marks_columns]
user_input_attendance = float(input("Enter attendance percentage: "))

# Predict marks
predicted_marks = marks_model.predict([user_input_marks])[0]
print(f"Predicted Total Marks: {predicted_marks}")

# Predict attendance
predicted_attendance = attendance_model.predict([[user_input_marks[0], user_input_marks[1], user_input_marks[2], user_input_marks[3], user_input_marks[4], predicted_marks]])[0]
print(f"Predicted Attendance: {predicted_attendance}")

# Predict pass/fail
predicted_pass_fail = pass_fail_model.predict([[user_input_marks[0], user_input_marks[1], user_input_marks[2], user_input_marks[3], user_input_marks[4], user_input_attendance]])[0]
print(f"Predicted Pass/Fail: {predicted_pass_fail}")

# Evaluate models
marks_predictions = marks_model.predict(X_test_marks)
attendance_predictions = attendance_model.predict(X_test_attendance)
pass_fail_predictions = pass_fail_model.predict(X_test_pass_fail)

mse_marks = mean_squared_error(y_test_marks, marks_predictions)
mse_attendance = mean_squared_error(y_test_attendance, attendance_predictions)
accuracy_pass_fail = accuracy_score(y_test_pass_fail, pass_fail_predictions)

print(f"\nMetrics for Marks Prediction:")
print(f"Mean Squared Error (MSE): {mse_marks}")

print(f"\nMetrics for Attendance Prediction:")
print(f"Mean Squared Error (MSE): {mse_attendance}")

print(f"\nMetrics for Pass/Fail Prediction:")
print(f"Accuracy: {accuracy_pass_fail}")
print(classification_report(y_test_pass_fail, pass_fail_predictions))
