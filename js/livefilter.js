(function (Drupal) {
  let doLiveFilter = function () {
    let filterText = this.value.toLowerCase();
    let elementsSelector = this.dataset.elementsSelector;
    let textSelector = this.dataset.textSelector;
    let minInput = parseInt(this.dataset.minInput, 10);

    let elements = document.querySelectorAll(elementsSelector);
    Array.from(elements).forEach(function (element) {
      // Filter by textSelector if given.
      let textElements = textSelector ?
        Array.from(element.querySelectorAll(textSelector)) : [element];
      let textContent = textElements.map(element => element.textContent).join();

      // Only filter when minInput chars.
      let match = (filterText.length < minInput) ? true :
        textContent.toLowerCase().indexOf(filterText) >= 0;

      // Write back match to data-livefilter-match.
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
