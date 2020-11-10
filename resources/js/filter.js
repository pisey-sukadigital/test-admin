//Vue moment js to show human readable date
import moment from "moment"; //Import Moment

//Vue Filter to make first letter Capital
Vue.filter("strToUpper", function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter("formatDate", function(date) {
    return moment(date).format('MMMM Do YYYY');
});

Vue.filter('myDate', function(created) {
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
});