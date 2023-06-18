const OpenModal = document.querySelector('#header-button');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal-close');

OpenModal.addEventListener('click',(e)=>{
    e.preventDefault(); // Oculta el comportamiento por defecto del evento (#)
    modal.classList.add('modal--show');
});

closeModal.addEventListener('click',(e)=>{
    e.preventDefault();
    modal.classList.remove('modal--show');
});

