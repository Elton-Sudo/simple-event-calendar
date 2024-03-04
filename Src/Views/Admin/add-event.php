<style>
    .form-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        width: 100%;
        max-width: 400px; 
    }

    .form-container form {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="form-wrap form-wrap">
    <div class="form-container">
        <form method="post" class="wp-admin-form" enctype="multipart/form-data">
            <h2>Add New Event</h2>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="regular-text" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="large-text" required></textarea>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="regular-text" required>
            
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" class="regular-text" required>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" class="regular-text" required>

            <label for="image">Image Upload:</label><br>
            <input type="file" id="imageUpload" name="image" accept="image/*"><br>
            <img id="previewImage" src="#" alt="Preview Image" style="display: none; max-width: 300px;">

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" class="regular-text" required>

            <label for="type">Keywords:</label>
            <input type="text" id="keywords" name="keywords[]" class="regular-text" required>

            <div class="wrap">
                <input type="submit" name="submit_event" value="Add Event" class="button button-primary">
                <a href="/wp-plugin/wp-admin/admin.php?page=simple-event-calendar-settings" class="button button-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#imageUpload").change(function() {
            var fileInput = this;
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage')
                        .attr('src', e.target.result)
                        .show();
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    });
</script>
