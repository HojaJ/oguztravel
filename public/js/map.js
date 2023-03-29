(function () {
    'use strict';
    let myMap, placeMark;
    ymaps.ready(init);

    function init() {
        myMap = new ymaps.Map("map", {
            center: [37.972890, 58.399656],
            zoom: 16
        });

        placeMark = new ymaps.Placemark([37.972890, 58.399656], {
            hintContent: 'Oguztravel',
            balloonContent: 'Oguztravel'
        });

        myMap.setType('yandex#map');
        myMap.geoObjects.add(placeMark);
        myMap.behaviors.disable('scrollZoom');

        myMap.balloon.open(myMap.getCenter(), { contentHeader: 'Oguztravel' });
    }
})();
