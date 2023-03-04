// Get the profile form element
const profileForm = document.getElementById('profile-form');

// Add event listener to form submit event
profileForm.addEventListener('submit', (event) => {
	// Prevent the default form submission behavior
	event.preventDefault();

	// Get the form values
	const username = document.getElementById('username').value;
	const age = document.getElementById('age').value;
	const dob = document.getElementById('dob').value;
	const contact = document.getElementById('contact').value;

	// Send an AJAX request to the server to update the user's profile
	$.ajax({
		url: 'update_profile.php',
		method: 'POST',
		data: {
			username: username,
			age: age,
			dob: dob,
			contact: contact
		},
		success: function(response) {
			alert(response);
		}
	});
});
