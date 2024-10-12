document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault(); // لمنع إعادة تحميل الصفحة

    const imageInput = document.getElementById('imageInput');
    const formData = new FormData();
    formData.append('image', imageInput.files[0]);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Image uploaded successfully!');
        } else {
            alert('Error uploading image.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
