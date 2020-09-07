/* global jsoptions:readonly */
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Vue from 'vue';
import Autocomplete from './components/Autocomplete';
import MultiSelectInput from './components/MultiSelectInput';
import Button from './components/Button';
import PreRegister from './components/Preregister';
import UniqueUrlCopy from './components/UniqueUrlCopy';
import Reservation from './partak/Reservation';
import ContactsOrder from './components/ContactsOrder';
import ShareButton from './partak/ShareButton';
import ProtectedSubmitButton from "./components/ProtectedSubmitButton";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('auto-complete', Autocomplete);
Vue.component('multiselectinput', MultiSelectInput);
Vue.component('protectedbutton', Button);
Vue.component('protected-submit-button', ProtectedSubmitButton);
Vue.component('preregister', PreRegister);
Vue.component('unique-url', UniqueUrlCopy);
Vue.component('contacts-order', ContactsOrder);
Vue.component('share-button', ShareButton);

new Vue({
  el: '#partakApp',
  components: {
    Reservation
  },
  data: {
    options: typeof jsoptions !== 'undefined' ? jsoptions : []
  },
  methods: {}
});

setTimeout(() => {
  $('#alert-success-wrapper > .alert').alert('close');
}, 3000);

const photoTypeSelect = document.getElementById('photo');
if (photoTypeSelect) {
  photoTypeSelect.addEventListener('change', onPhotoTypeSelected);
  photoTypeSelect.dispatchEvent(new Event('change'));
}

function onPhotoTypeSelected(event) {
  const photoFileInput = document.getElementById('custom_photo_input');
  const form = photoFileInput.closest('form');
  if (event.target.value === 'custom') {
    photoFileInput.parentElement.style.display = 'block';
    photoFileInput.addEventListener('change', onPhotoSelected);
  } else {
    photoFileInput.value = photoFileInput.defaultValue;
    photoFileInput.dispatchEvent(new Event('change'));
    photoFileInput.removeEventListener('change', onPhotoSelected);
    photoFileInput.parentElement.style.display = 'none';
  }
  form.addEventListener('submit', onContactFormSubmit);
}

function onPhotoSelected(event) {
  const file = event.target.files[0];
  const previewWrapper = document.getElementById('photo-preview-wrapper');
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');
  const image = document.createElement('img');
  const reader = new FileReader();
  let ratio;
  let MIN_RATIO;
  let dx = 0;
  let dy = 0;
  let isDragging = false;
  const mousePosition = { x: 0, y: 0 };
  let MIN_DX;
  let MIN_DY;

  canvas.width = 360;
  canvas.height = 360;
  canvas.addEventListener('wheel', onWheel);
  canvas.addEventListener('mousedown', onMouseDown);
  canvas.addEventListener('mousemove', onMouseMove);
  canvas.addEventListener('mouseup', onMouseUp);
  canvas.addEventListener('mouseleave', onMouseUp);

  reader.addEventListener('load', event => {
    image.src = event.target.result;
  });

  image.addEventListener('load', onImageLoad);

  function onWheel(event) {
    event.preventDefault();
    const oldRatio = ratio;
    if (event.deltaY > 0 && ratio > MIN_RATIO) {
      ratio *= 0.95;
      if (ratio < MIN_RATIO) {
        ratio = MIN_RATIO;
      }
    } else if (event.deltaY < 0) {
      ratio *= 1.04;
    }
    const scale = ratio / oldRatio;
    MIN_DX = canvas.width / ratio - image.width;
    MIN_DY = canvas.height / ratio - image.height;
    dx = dx - (canvas.width / 2) * (1 / oldRatio - 1 / ratio);
    dy = dy - (canvas.height / 2) * (1 / oldRatio - 1 / ratio);
    checkAxisBoundaries();
    ctx.scale(scale, scale);
    ctx.drawImage(image, dx, dy);
  }

  function onMouseDown(event) {
    isDragging = true;
    mousePosition.x = event.clientX;
    mousePosition.y = event.clientY;
  }

  function onMouseMove(event) {
    if (isDragging) {
      event.preventDefault();
      dx += (event.clientX - mousePosition.x) / ratio;
      dy += (event.clientY - mousePosition.y) / ratio;
      checkAxisBoundaries();
      mousePosition.x = event.clientX;
      mousePosition.y = event.clientY;
      ctx.drawImage(image, dx, dy);
    }
  }

  function onMouseUp(event) {
    event.preventDefault();
    isDragging = false;
    mousePosition.x = 0;
    mousePosition.y = 0;
  }

  function onImageLoad() {
    ratio = canvas.height / image.height;
    dx = (image.height - image.width) / 2;
    if (image.width < image.height) {
      ratio = canvas.width / image.width;
      dy = -dx;
      dx = 0;
    }
    MIN_RATIO = ratio;
    MIN_DX = canvas.width / ratio - image.width;
    MIN_DY = canvas.height / ratio - image.height;
    ctx.scale(ratio, ratio);
    ctx.drawImage(image, dx, dy);
    previewWrapper.innerHTML = '';
    previewWrapper.appendChild(canvas);
  }

  function checkAxisBoundaries() {
    if (dx > 0) {
      dx = 0;
    } else if (dx < MIN_DX) {
      dx = MIN_DX;
    }
    if (dy > 0) {
      dy = 0;
    } else if (dy < MIN_DY) {
      dy = MIN_DY;
    }
  }

  if (file != null) {
    reader.readAsDataURL(file);
  } else {
    previewWrapper.innerHTML = '';
  }
}

function onContactFormSubmit(event) {
  const form = event.target;
  const canvas = document
    .getElementById('photo-preview-wrapper')
    .querySelector('canvas');
  if (canvas != null) {
    const dataURL = canvas.toDataURL('image/jpeg');
    const input = document.createElement('input');
    input.name = 'custom_photo';
    // input.value = dataURItoFile(dataURL, "name");
    input.value = dataURL;
    form.appendChild(input);
    const fileInput = document.getElementById('custom_photo_input');
    fileInput.value = null;
  }
}

function dataURItoFile(dataURI, name) {
  // convert base64/URLEncoded data component to raw binary data held in a string
  let byteString;
  if (dataURI.split(',')[0].indexOf('base64') >= 0)
    byteString = atob(dataURI.split(',')[1]);
  else byteString = unescape(dataURI.split(',')[1]);

  // separate out the mime component
  const mimeString = dataURI
    .split(',')[0]
    .split(':')[1]
    .split(';')[0];

  // write the bytes of the string to a typed array
  const ia = new Uint8Array(byteString.length);
  for (let i = 0; i < byteString.length; i++) {
    ia[i] = byteString.charCodeAt(i);
  }

  return new File(ia, name, { type: mimeString });
}

const formRegister = document.getElementById('form-register');
if (formRegister != null) {
  const modalToggleBtn = formRegister.querySelector('button[data-toggle=modal]');
  formRegister.addEventListener('keypress', (event) => {
    if (event.key === 'Enter' && formRegister.reportValidity()) {
      event.preventDefault();
      event.stopPropagation();
      modalToggleBtn.click();
    }
  });
  modalToggleBtn.addEventListener('click', (event) => {
    if (!formRegister.reportValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }
  });
}
