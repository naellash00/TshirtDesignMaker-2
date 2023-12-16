// Function to change the T-shirt color based on user selection

function changeTshirtColor() {
  const tshirtImg = document.getElementById ('tshirt-img');
  const colorSelector = document.getElementById('color');

  switch (colorSelector.value) {
    case 'white':
      tshirtImg.src = 'Tshirts-images/WhiteT-shirt1.png';
      break;
    case 'yellow':
      tshirtImg.src = 'Tshirts-images/YallowT-shirt1.png';
      break;
    case 'pink':
      tshirtImg.src = 'Tshirts-images/PinkT-shirt1.png';
      break;
    case 'blue':
      tshirtImg.src = 'Tshirts-images/BlueT-shirt.png';
      break;
    case 'baby-pink':
      tshirtImg.src = 'Tshirts-images/BabyPinkT-shirt.png';
      break;
  }

}


// Function to customize the T-shirt with user input
function customizeTshirt() {
  const textOverlay = document.getElementById('text-overlay');
  const logoOverlay = document.getElementById('logo-overlay');
  const textInput = document.getElementById('text');
  const textColorInput = document.getElementById('text-color');
  const tshirtSizeInput = document.getElementById('tshirt-size');

  // Update text overlay content and color
  textOverlay.textContent = textInput.value;
  textOverlay.style.color = textColorInput.value;

  // Update T-shirt size
  const tshirtSize = tshirtSizeInput.value;
  const tshirtImg = document.getElementById('tshirt-img');
}

// Function to load and display the selected logo
function loadLogo() {
  const logoInput = document.getElementById('logo');
  const logoOverlay = document.getElementById('logo-overlay');
  const file = logoInput.files[0];

  if (file) {
    // Read the selected logo and set it as the background image
    const reader = new FileReader();
    reader.onload = function (e) {
      logoOverlay.style.backgroundImage = `url('${e.target.result}')`;
      resizeLogo();
    };
    reader.readAsDataURL(file);
  }
}
// Function to resize the displayed logo based on user input
function resizeLogo() {
  const logoOverlay = document.getElementById('logo-overlay');
  const logoSizeInput = document.getElementById('logo-size');
  const logoSize = logoSizeInput.value + 'px';

  // Set the width and height of the logo overlay
  logoOverlay.style.width = logoSize;
  logoOverlay.style.height = logoSize;

  // Make the logo overlay draggable
  logoOverlay.draggable = true;

  // Prevent the default drag behavior to enable custom dragging
  logoOverlay.addEventListener('dragstart', (e) => {
    e.preventDefault();
  });

  // Update the position of the logo overlay after dragging
  logoOverlay.addEventListener('dragend', (e) => {
    const x = e.clientX;
    const y = e.clientY;

    // Set the new position of the logo overlay
    logoOverlay.style.left = x + 'px';
    logoOverlay.style.top = y + 'px';
  });
}



function previousDesign() {
  console.log('previousDesign');
  var pageURL = 'saveD/previous-design.php';
  window.location.href = pageURL;
}

// script.js

function handleTextEntry() {
  const textInput = document.getElementById('text');
  const wordCountMessage = document.getElementById('wordCountMessage');
  const wordLimit = 3;

  textInput.addEventListener('input', function () {
    const words = textInput.value.split(/\s+/).filter(function (word) {
      return word.length > 0;
    });

    if (words.length > wordLimit) {
      // Truncate the text to the word limit
      textInput.value = words.slice(0, wordLimit).join(' ');
    }

    const remainingWords = wordLimit - words.length;
    wordCountMessage.textContent = `Words remaining: ${remainingWords}`;
  });
}
document.addEventListener('DOMContentLoaded', function () {

});


// Function to save the design
function saveDesign() {

  const logoInput = document.getElementById('logo').files[0];
  const logoOverlay = document.getElementById('logo-overlay');
  const tshirtImg = document.getElementById('tshirt-img');
  const words = document.getElementById('text').value;
  const logoSize = document.getElementById('logo-size').value;
  const wordsColor = document.getElementById('text-color').value;
  const tshirtSize = document.getElementById('tshirt-size').value;
  const quantity = document.getElementById('quantity').value;
  const formData = new FormData();



  // Append the necessary data to the FormData object

  formData.append('logo_image', logoInput); //  logo image file
  formData.append('logo_size', logoSize);
  // Assuming tshirtImg.src contains the image URL
  const imageUrl = tshirtImg.src;
  const imageName = imageUrl.split('/').pop();

  // imageName will now contain the extracted image filename
  console.log(imageName);
  formData.append('tscolor_url', imageName);
  formData.append('words', words);
  formData.append('words_color', wordsColor);
  formData.append('priproduct', '20$');
  formData.append('ts_size', tshirtSize);
  formData.append('quantity', quantity);
  //	
  // Send the data to the server (save.php) for processing
  fetch('../Tshirts-design/save.php', {//../Tshirts-design/js/main.js
    method: 'POST',
    body: formData,
  })
    .then(response => response.text())
    .then(data => {
      console.log('Success:', data);
      if (data.match('1')) {
        alert('Please Login First');
        window.location.href = '../signup_and_login/index.php';
      }
      else {
        alert(data);
      }


    })
    .catch((error) => {
      console.error('Error:', error);
      alert('Failed to save design.');
    });
}

// Function to get file extension from file name
function getFileExtension(filename) {
  const dotIndex = filename.lastIndexOf('.');
  if (dotIndex !== -1) {
    return filename.substring(dotIndex + 1);
  }
  return '';
}


function generateRandomNumber() {
  return Math.floor(Math.random() * 100);
}

var randomNumber = generateRandomNumber();
console.log(randomNumber);
