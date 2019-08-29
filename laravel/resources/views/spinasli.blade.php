
<html>
    <head>
        <title>HTML5 Canvas Winning Wheel</title>

        <link rel="stylesheet" type="text/css" href="{{asset('spin/main.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/bootstrap.min.css')}}">    
        <link rel="stylesheet" type="text/css" href="{{asset('assetss/font-awesome/css/font-awesome.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset ('assetss/js/izi-toast/css/iziToast.css') }}">
        


        <script src="{{asset('assetss/js/Winwheel.js')}}"></script>
        <script src="{{asset('assetss/js/jquery-2.1.1.js')}}"></script>
        <script src="{{asset('assetss/js/bootstrap.min.js')}}"></script>    
        <script src="{{ asset ('assetss/js/izi-toast/js/iziToast.js') }}"></script>



<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    </head>
    <body>

<div class="row">
    <div class="col-xs-4"> 
        <table class="table">
            <tr>
                <th>Kode</th>
                <th>: {{Session::get('kode')}} <input id="kode" type="hidden" class="form-control input-sm" name="" value="{{Session::get('kode')}}">
                <input id="group" type="hidden" name="group" value="{{$data[0]->group}}" ></th>
                <th>Sisa Waktu</th>
                <th>: <span id="countdown" class="timer">00:00:00:00</span></th>
            </tr>
        </table>
    </div>
</div>
    
        <div align="center">            
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>                    
                    <td>                        
                        <div class="power_controls">
                            <br />
                            <br />
                            <table class="power" cellpadding="10" cellspacing="0">
                                <tr>
                                    <th align="center">Power</th>
                                </tr>
                                <tr>
                                    <td width="78" align="center" id="pw3" onClick="powerSelected(3);">High</td>
                                </tr>
                                <tr>
                                    <td align="center" id="pw2" onClick="powerSelected(2);">Med</td>
                                </tr>
                                <tr>
                                    <td align="center" id="pw1" onClick="powerSelected(1);">Low</td>
                                </tr>
                            </table>
                            <br />
                            <img id="spin_button" src="{{ asset('spin/spin_off.png') }}" alt="Spin" onClick="startSpin();" />
                            <br /><br />
                            <!-- &nbsp;&nbsp;<a href="#" onClick="resetWheel(); return false;">Play Again</a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(reset) -->
                        </div>
                    </td>
                    <td width="438" height="582" class="the_wheel" align="center" valign="center">
                        <canvas id="canvas" width="434" height="434">
                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                        </canvas>
                    </td>
                </tr>
            </table>
        </div>
<script type="text/javascript">
var upgradeTime = '{{$data[0]->total}}';
var seconds = upgradeTime;
function timer() {
  var days        = Math.floor(seconds/24/60/60);
  var hoursLeft   = Math.floor((seconds) - (days*86400));
  var hours       = Math.floor(hoursLeft/3600);
  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
  var minutes     = Math.floor(minutesLeft/60);
  var remainingSeconds = seconds % 60;
  function pad(n) {
    return (n < 10 ? "0" + n : n);
  }
  document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
  if (seconds == 0) {
    clearInterval(countdownTimer);
    document.getElementById('countdown').innerHTML = "Completed";
  } else {
    seconds--;
  }
}
var countdownTimer = setInterval('timer()', 1000);
</script>
<!-- [
                   {'fillStyle' : '#eae56f', 'text' : 'Prize 1'},
                   {'fillStyle' : '#89f26e', 'text' : 'Prize 2'},
                   {'fillStyle' : '#7de6ef', 'text' : 'Prize 3'},
                   {'fillStyle' : '#e7706f', 'text' : 'Prize 4'},
                   {'fillStyle' : '#eae56f', 'text' : 'Prize 5'},
                   {'fillStyle' : '#89f26e', 'text' : 'Prize 6'},
                   {'fillStyle' : '#7de6ef', 'text' : 'Prize 7'},
                   {'fillStyle' : '#e7706f', 'text' : 'Prize 8'}
                ] -->
        <script>
            var baseUrl = "{{url('/')}}";
            var hadiah={!! json_encode($h) !!}
            var numSegments={{$hitung}};
            /*var hadiah={{ json_encode($h) }}*/
            /*var hadiah=JSON.parse('{{ json_encode($h) }}');*/
            
            // Create new wheel object specifying the parameters at creation time.
            let theWheel = new Winwheel({
                'numSegments'  : numSegments,     // Specify number of segments.
                'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
                'textFontSize' : 28,    // Set font size as desired.
                'segments'     :        // Define segments including colour and text.
                hadiah
                ,
                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 15,
                    'spins'    : 8,
                    'callbackFinished' : alertPrize,
                    'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
                'pins' :
                {
                    'number' : 16   // Number of pins. They space evenly around the wheel.
                }
            });

            // -----------------------------------------------------------------
            // This function is called when the segment under the prize pointer changes
            // we can play a small tick sound here like you would expect on real prizewheels.
            // -----------------------------------------------------------------
            let audio = new Audio("{{ asset('spin/tick.mp3') }}");  // Create audio object and load tick.mp3 file.
            /*{{ asset('spin/tick.mp3') }}*/

            function playSound()
            {
                // Stop and rewind the sound if it already happens to be playing.
                audio.pause();
                audio.currentTime = 0;

                // Play the sound.
                audio.play();
            }

            // -------------------------------------------------------
            // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters
            // note the indicated segment is passed in as a parmeter as 99% of the time you will want to know this to inform the user of their prize.
            // -------------------------------------------------------
            function alertPrize(indicatedSegment)
            {
                // Do basic alert of the segment text.
                // You would probably want to do something more interesting with this information.
                /*alert("You have won " + indicatedSegment.text);*/


            iziToast.success({                              
                    message: "<i class='fa fa-clock-o'></i><i> Selamat Anda Mendapat "+indicatedSegment.text+"</i>",
                    position: 'topRight',
            });

        
         $.ajax({
          url     :  baseUrl+'/main/update-hadiah',
          type    : 'get', 
          data    :  "group="+$('#group').val()+"&kode="+$('#kode').val()+"&hadiah="+indicatedSegment.text+"&_token={{ csrf_token() }}",
          dataType: 'json',
          success : function(response){    
                    if(response.status=='sukses'){
                        window.location = baseUrl+response.redirect;
                    }else if(response.status=='gagal'){
                        alert(response.data);

                    }
                    
          },

          error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                /*alert('');
                alert('Internal Server Error [500].');*/
                window.location = baseUrl+'/kode_user';
            } else if (exception === 'parsererror') {
                /*alert('Requested JSON parse failed.');*/
                location.reload();
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }


      });
    



            }

            // =======================================================================================================================
            // Code below for the power controls etc which is entirely optional. You can spin the wheel simply by
            // calling theWheel.startAnimation();
            // =======================================================================================================================
            let wheelPower    = 0;
            let wheelSpinning = false;

            // -------------------------------------------------------
            // Function to handle the onClick on the power buttons.
            // -------------------------------------------------------
            function powerSelected(powerLevel)
            {
                // Ensure that power can't be changed while wheel is spinning.
                if (wheelSpinning == false) {
                    // Reset all to grey incase this is not the first time the user has selected the power.
                    document.getElementById('pw1').className = "";
                    document.getElementById('pw2').className = "";
                    document.getElementById('pw3').className = "";

                    // Now light up all cells below-and-including the one selected by changing the class.
                    if (powerLevel >= 1) {
                        document.getElementById('pw1').className = "pw1";
                    }

                    if (powerLevel >= 2) {
                        document.getElementById('pw2').className = "pw2";
                    }

                    if (powerLevel >= 3) {
                        document.getElementById('pw3').className = "pw3";
                    }

                    // Set wheelPower var used when spin button is clicked.
                    wheelPower = powerLevel;

                    // Light up the spin button by changing it's source image and adding a clickable class to it.
                    document.getElementById('spin_button').src = "{{ asset('spin/spin_off.png') }}";
                    document.getElementById('spin_button').className = "clickable";
                }
            }

            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            function startSpin()
            {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false) {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                    if (wheelPower == 1) {
                        theWheel.animation.spins = 3;
                    } else if (wheelPower == 2) {
                        theWheel.animation.spins = 8;
                    } else if (wheelPower == 3) {
                        theWheel.animation.spins = 15;
                    }

                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_button').src       = "{{ asset('spin/spin_off.png') }}";
                    document.getElementById('spin_button').className = "";

                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();

                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }

            // -------------------------------------------------------
            // Function for reset button.
            // -------------------------------------------------------
            function resetWheel()
            {
                theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                theWheel.draw();                // Call draw to render changes to the wheel.

                document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
                document.getElementById('pw2').className = "";
                document.getElementById('pw3').className = "";

                wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
            }
        </script>
    </body>
</html>
