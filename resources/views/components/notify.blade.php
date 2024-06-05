<div x-data="{ open: false }" x-show="open" x-on:notify.window="Toastify({
    text: $event.detail.message,
    duration: 3000,
    newWindow: true,
    close: true,
    gravity: 'top',
    position: 'right',
    stopOnFocus: true,
    style: {
      background: ($event.detail.style === 'success') ? '#334155' : '#dc2626',
    },
  }).showToast();">

</div>
