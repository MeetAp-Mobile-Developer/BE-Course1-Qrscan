<!DOCTYPE html>
<html>
<head>
    <title>Register Participant</title>
</head>
<body>
    <h1>Register Participant</h1>
    <form action="{{ route('participants.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
