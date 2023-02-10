// The following JavaScript calls init to build a NodeList (elements) of elements with the hidden class.

// It then calls checkPosition to loop through the elements and calculate whether they are visible. If an element is visible, checkPosition removes the hidden class and adds the animate__fadeInUp class.

// The code adds checkPosition as a scroll event listener, and init as a resize event listener.


(function() {
  var elements;
  var windowHeight;

  function init() {
    elements = document.querySelectorAll('.hidden');
    windowHeight = window.innerHeight;
  }

  function checkPosition() {
    for (var i = 0; i < elements.length; i++) {
      var element = elements[i];
      var positionFromTop = elements[i].getBoundingClientRect().top;

      if (positionFromTop - windowHeight <= 0) {
        element.classList.add('animate__fadeInUp');
        element.classList.remove('hidden');
      }
    }
  }

  window.addEventListener('scroll', checkPosition);
  window.addEventListener('resize', init);

  init();
  checkPosition();
})();