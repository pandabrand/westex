const home_page = document.querySelector('body.home')
  
const windowOpener = (event) => {
  window.open(event.target.closest('.jsExhibitionLink').dataset.url, '_self')
}

if (home_page) {
  const jsLinks = document.querySelectorAll('.jsExhibitionLink');
  
  jsLinks.forEach((link) => link.addEventListener('click', windowOpener))
}
