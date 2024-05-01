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
function mouseHover(element) {
  const galleryItems = document.querySelectorAll('.gallery-item');
  
  galleryItems.forEach(item => {
      if (item !== element) {
          item.style.transform = 'scale(0.95)';  // Scales down non-hovered items
      } else {
          item.style.transform = 'scale(1.25)'; // Scales up the hovered item
          item.style.zIndex = '50';
      }
  });
}

function mouseLeave() {
  const galleryItems = document.querySelectorAll('.gallery-item');
  galleryItems.forEach(item => {
      item.style.transform = 'scale(1)';    // Resets scale when not hovered
      item.style.zIndex = '10';             // Resets zIndex to normal
  });
}