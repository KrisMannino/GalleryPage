function toggleForm() {
  var form = document.getElementById('formContainer');
  if (form.style.display === 'block') {
    form.style.display = 'none';
    document.getElementById("toggleBtn").textContent="Add Image";
  } else {
    form.style.display = 'block';
    document.getElementById("toggleBtn").textContent="Hide Form";

  }
}
