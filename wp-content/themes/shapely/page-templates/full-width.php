<?php
/*
Template Name: Full Width
Template Post Type: post, page
*/
get_header(); ?>

<?php $layout_class = shapely_get_layout_class(); ?>
<div class="container">
	<section>
		<h1>Add Event</h1>
		<form id="eventForm">
			<label for="title">Title:</label><br>
			<input type="text" id="title" name="title" required><br>
			<div style="
				display: flex;
				justify-content: space-between;
				">
				<div>
					<label for="date">Date:</label>
					<input type="date" id="date" name="date" required>
				</div>
				<div>
					<label for="startTime">Start Time:</label>
					<input type="time" id="startTime" name="startTime" required>
				</div>
				<div>
					<label for="endTime">End Time:</label>
					<input type="time" id="endTime" name="endTime" required>
				</div>
			</div>
			<label for="description">Description:</label><br>
			<textarea id="description" name="description" rows="4" cols="50"></textarea>
			<br>
			<button class="btn" type="button" onclick="addEventToGoogleCalendar()">Add to Google Calendar</button>
		</form>
		<script>
			function addEventToGoogleCalendar() {
				// Retrieve form data
				const title = document.getElementById('title').value;
				const date = document.getElementById('date').value;
				const startTime = document.getElementById('startTime').value;
				const endTime = document.getElementById('endTime').value;
				const description = document.getElementById('description').value;
			
				// Construct event object
				const event = {
					'summary': title,
					'start': {
						'dateTime': `${date}T${startTime}:00`,
						'timeZone': 'Your Time Zone'
					},
					'end': {
						'dateTime': `${date}T${endTime}:00`,
						'timeZone': 'Your Time Zone'
					},
					'description': description
				};
			
				// Add event to Google Calendar (using Google Calendar API)
				// You need to implement this part using JavaScript and Google Calendar API
				// Refer to the Google Calendar API documentation for details on how to do this
				console.log(event);
				// Example: Call function to add event using Google Calendar API
				// addEvent(event);
			}
		</script>
	</section>
</div>
<script>
function addEventToGoogleCalendar() {
    // Retrieve form data
    const title = document.getElementById('title').value;
    const date = document.getElementById('date').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;
    const description = document.getElementById('description').value;

    // AJAX request
    const xhr = new XMLHttpRequest();
    const url = '<?php echo home_url("/add_event.php"); ?>'; // Base URL + path to PHP script
    const params = `title=${title}&date=${date}&startTime=${startTime}&endTime=${endTime}&description=${description}`;
	xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
        }
    }

    xhr.send(params);
}
</script>
<?php
get_footer();
