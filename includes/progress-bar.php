<?php
// Prevent direct access
if (!defined('SECURE_ACCESS')) {
    http_response_code(403);
    exit('Access denied');
}
?> 
<style>
    #scroll-progress {
  position: fixed;
  top: 0;
  left: 0;
  width: 0%;
  height: 5px;
  background-color:rgb(236, 103, 26); /* Green color */
  z-index: 9999;
}

</style>
<div id="scroll-progress"></div>
<script>
window.addEventListener('scroll', () => {
  const scrollProgress = document.getElementById('scroll-progress');
  const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
  const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  const scrollPercent = (scrollTop / scrollHeight) * 100;
  scrollProgress.style.width = `${scrollPercent}%`;
});

</script>