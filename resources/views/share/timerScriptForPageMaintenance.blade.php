<script>
    @if(isset($viewPageDetails) && $viewPageDetails == 0)
        // Page maintenance timer
        document.getElementById('timer').innerHTML = @php echo isset($pageMaintenanceTime) ? $pageMaintenanceTime : '50 + ":" + 60' @endphp;
        startTimer();
        function startTimer()
        {
            var presentTime = document.getElementById('timer').innerHTML;
            var timeArray = presentTime.split(/[:]+/);
            var m = timeArray[0];
            var s = checkSecond((timeArray[1] - 1));
            if(s==59){m=m-1}
            if(m<0){ return }
            document.getElementById('timer').innerHTML =
                m + ":" + s;
            console.log(m)
            setTimeout(startTimer, 1000);
        }
        function checkSecond(sec)
        {
            if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
            if (sec < 0) {sec = "59"};
            return sec;
        }
    @endif
</script>
