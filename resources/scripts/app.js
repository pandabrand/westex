import {domReady} from '@roots/sage/client';
import 'bootstrap'
import { Fancybox } from '@fancyapps/ui'
import 'jquery';
import 'masonry-layout'
import Masonry from 'masonry-layout';
import 'tether'
import imagesLoaded from 'imagesloaded';
import Flickity from 'flickity';
import fizzyUIUtils from 'fizzy-ui-utils'

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // application code
  
  const home_page = document.querySelector('body.home')
  
  const windowOpener = (event) => {
    window.open(event.target.closest('.jsExhibitionLink').dataset.url, '_self')
  }
  
  if (home_page) {
    const jsLinks = document.querySelectorAll('.jsExhibitionLink');
    
    jsLinks.forEach((link) => link.addEventListener('click', windowOpener))
  }

  const grid = document.querySelector('.grid')
  const front_carousel = document.querySelector('.front-carousel')

  if( grid ) {
    var msnry = new Masonry(grid, {
      itemSelector: '.grid-item',
      percentPosition: true,
      columnWidth: '.grid-sizer'
    });
    const imgLoad = imagesLoaded( document.querySelector( '.grid' ) )
    imgLoad.on( 'always', (instance) => console.log(instance) );
    imgLoad.on( 'progress', () => msnry.layout() );
    imgLoad.on( 'done', () => msnry.layout() );
  }

  Fancybox.bind("[data-fancybox]", {
    protect: true,
    buttons: true,
    thumbs: true,
    caption : function( fancybox, carousel, slide ) {
      return slide.caption;
    },
  })

  if ( front_carousel ) {
    const flkty = new Flickity( front_carousel, {
      // options
      cellAlign: 'left',
      contain: true,
      prevNextButtons: false,
      pageDots: false,
    });

    const button_group = document.querySelector('.btn-group')
    let buttons = button_group.querySelectorAll('.btn')
    buttons = fizzyUIUtils.makeArray( buttons )

    button_group.addEventListener('click', ( event ) => {
      if ( !event.target.matches( '.btn' ) ) {
        return
      }

      const index = buttons.indexOf( event.target )
      flkty.select( index, false, true )
    })
  }
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
