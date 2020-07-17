$(document).ready(function () {
    // returns the number of minutes ahead or behind green which meridian
    var offset = new Date().getTimezoneOffset();
    //return the number of miliseconds since 1970/01/01:*
    var timestamp = new Date().getTime();
    //we convert our time to : Universal time coordinated/universal coordinated time
    var utc_timestamp = timestamp + (60000 * offset);
    $("#time_zone_offset").val(offset);
    $("#utc_timestamp").val(utc_timestamp);
})