(function (Drupal) {
  let doLiveFilter = function () {
    let filterText = this.value.toLowerCase();
    let containerSelector = this.dataset.containerSelector;
    let textSelector = this.dataset.textSelector;

    let container = document.querySelector(containerSelector);
    Array.from(container.children).forEach(function (element) {
      let textElements = textSelector ?
        Array.from(element.querySelectorAll(textSelector)) : [element];
      let textContent = textElements.map(element => element.textContent).join();
      let match = (filterText.length <= 2) ? true :
        textContent.toLowerCase().indexOf(filterText) >= 0;
      element.dataset.livefilterMatch = match ? '1' : '0';
      // todo: Add highlight. https://codepen.io/tniezurawski/pen/wvzyVEE
    });
  };
  Drupal.behaviors.livefilter = {
    attach: function (context, settings) {
      context.querySelectorAll('.livefilter-value').forEach(
        function(element) {
          element.addEventListener('input', doLiveFilter);
        }
      );
    },
  }
})(Drupal)
