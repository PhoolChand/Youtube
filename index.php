<div class="content">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
	    $(document).ready(function() {
			    
         $('#youtubevideos' ).on( 'click', 'a', function () {
             var url = this.title;
             var title = "Newwise Videos";
             popupwindow(url,title,500,400);
         });			
             
          $.get(
             "https://www.googleapis.com/youtube/v3/channels",{
             part : 'contentDetails', 
             forUsername : 'aajtak',
             key: 'AIzaSyCfhiJ9txod8n_IUXzrSbZ4UtYpf3heprA'},
             function(data) {
                $.each( data.items, function( i, item ) {
                    pid = item.contentDetails.relatedPlaylists.uploads;
                    getVids(pid);
                });
            }
          );
 
          //Get Videos
          function getVids(pid){
             $.get(
                  "https://www.googleapis.com/youtube/v3/playlistItems",{
                  part : 'snippet,contentDetails', 
                  maxResults : 6,
                  playlistId : pid,
                  key: 'AIzaSyCfhiJ9txod8n_IUXzrSbZ4UtYpf3heprA'},
                  function(data) {
                      var results;
                      $.each(data.items, function( i, item ) {
                          results = "<div id='channel_div' >";
                          results += "<div class='video' id='video0' style='height:226px;'><iframe width='170' height='170' src='https://www.youtube.com/embed/"+ item.contentDetails.videoId + "' frameborder='0' allowfullscreen></iframe><br/>";
                          results += "<a class='youtube' title='http://www.youtube.com/embed/"+ item.contentDetails.videoId + "' alt='"+ item.snippet.title +"'>"+ item.snippet.title +"</a><p>Author: "+item.snippet.channelTitle+"</p></div></div>";
                          //results+= '<li>'+ item.resourceId.videoId +'</li>';
                          $('#youtubevideos').append(results);
                      });
                  }
              );
          }
                      
          function popupwindow(url, title, w, h) {
             var left = (screen.width/2)-(w/2);
             var top = (screen.height/2)-(h/2);
             return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
           }
       
         });

</script>
<div id="youtubevideos"></div>
<div style="clear: both"></div>    
</div>
