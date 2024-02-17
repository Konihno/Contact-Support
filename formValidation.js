document.getElementById('contactForm').addEventListener('submit', function(event) {
    var isValid = true;
    var name = document.getElementById('name').value;
    var firstname = document.getElementById('firstname').value;
    var email = document.getElementById('email').value;
    var description = document.getElementById('description').value;

    if (!isValid) {
        event.preventDefault(); 
    }
    
});