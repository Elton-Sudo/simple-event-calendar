<h2>Add New Event</h2>

<form method="post">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br>
    
    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br>
    
    <label for="date">Date:</label><br>
    <input type="date" id="date" name="date" required><br>
    
    <label for="time">Time:</label><br>
    <input type="time" id="time" name="time" required><br>
    
    <label for="location">Location:</label><br>
    <input type="text" id="location" name="location" required><br>
    
    <label for="image">Image URL:</label><br>
    <input type="text" id="image" name="image"><br>
    
    <label for="type">Type:</label><br>
    <input type="text" id="type" name="type" required><br>
    
    <input type="submit" name="submit_event" value="Add Event">
</form>
