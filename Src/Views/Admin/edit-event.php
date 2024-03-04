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
            <input type="hidden" name="event_id" value="<?= esc_attr($event->id); ?>">
            <h2>Edit Event <?= esc_attr($event->title); ?></h2>
            <label for="title">Title:</label>
            <input type="text" id="event_title" name="event_title" value="<?= esc_attr($event->title); ?>" class="regular-text" >
            
            <label for="description">Description:</label>
            <textarea id="event_description" name="event_description" class="regular-text" ><?= esc_textarea($event->description); ?></textarea>
            
            <label for="date">Date:</label>
            <input type="date" id="event_date" name="event_date" value="<?= esc_attr($event->date); ?>" class="regular-text" >
            
            <label for="time">Time:</label>
            <input type="time" id="event_time" name="event_time" value="<?= esc_attr($event->time); ?>" class="regular-text" >
            
            <label for="location">Location:</label>
            <input type="text" id="event_location" name="event_location" value="<?= esc_attr($event->location); ?>" class="regular-text" >

            <label for="image">Image Upload:</label>
            <input type="file" id="imageUpload" name="event_image" accept="image/*">
            <input type="hidden" id="imageUpload" name="current_image" value="<?= esc_attr($event->image); ?>">
            <img id="previewImage" src="#" alt="Preview Image" style="display: none; max-width: 300px;">

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" class="regular-text" value="<?= esc_attr($event->type); ?>" class="regular-text" >

            <label for="type">Keywords:</label>
            <input type="text" id="keywords" name="keywords[]" class="regular-text">

            <div class="wrap">
                <input type="submit" name="update_event" value="Update Event" class="button button-primary">
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
