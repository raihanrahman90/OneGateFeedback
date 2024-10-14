        </div>
      </div>
    </div>
  </body> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Bind the form submit event
        $('#form').on('submit', function() {
        // Show the loading screen
            $('#loading-screen').addClass("d-block");
        });
    });
    </script>
</html>