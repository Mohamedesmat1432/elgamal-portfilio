<div x-data="{ open: false }" x-show="open" x-on:notify.window="Toastify({
    text: $event.detail.message,
    duration: 3000,
    newWindow: true,
    close: true,
    gravity: 'top',
    position: 'right',
    stopOnFocus: true,
    style: {
      background: ($event.detail.style === 'success') ? 'linear-gradient(to right, #00b09b, #96c93d)' : 'linear-gradient(to right, #00b09b, #96c93d)',
      borderRaduis:'5px',
    },
  }).showToast();">

</div>
