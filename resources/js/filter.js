//Vue moment js to show human readable date
import moment from "moment"; //Import Moment

//Vue Filter to make first letter Capital
Vue.filter("strToUpper", function(text) {
    if (text == 'undefined' || text == '') return '';
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter("formatDate", function(date) {
    if (date == 'undefined' || date == '') return '';
    return moment(date).format('MMMM Do YYYY, h:mm:ss a');
});

Vue.filter('myDate', function(date) {
    if (date == 'undefined' || date == '') return '';
    return moment(date).format('MMMM Do YYYY, h:mm:ss a');
});

Vue.filter("substring", function(text) {
    if (text == 'undefined' || text == '') return '';
    return text.length <= 15 ? text : text.substring(0, 15, ) + '...';
});