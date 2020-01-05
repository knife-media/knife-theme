/**
 * Table of contents links scroller
 *
 * @since 1.10
 */

(function() {
  var post = document.querySelector('.post');


  /**
   * Check if post element exists
   */
  if(post === null) {
    return false;
  }


  /**
   * Click listeners for toc links
   */
  var links = post.querySelectorAll('.figure.figure--toc a');

  for(var i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function(e) {
      e.preventDefault();

      var title = document.querySelector(this.hash);

      if(title === null) {
        return;
      }

      var rect = title.getBoundingClientRect();

      // Get title offset
      var offset = rect.top + window.pageYOffset || document.documentElement.scrollTop;

      // Check if can scroll smoothly
      if('scrollBehavior' in document.documentElement.style) {
        return window.scrollTo({top: offset - 76, behavior: 'smooth'});
      }

      window.scrollTo(offset - 76, 0);
      window.scrollTo({top: offset - 76, behavior: 'smooth'});
    });
  }
})();
