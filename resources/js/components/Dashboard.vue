<template>
     <div class="bg-image" style="height: 300px;">

     </div>

   </template>
   
   <script>
   export default {
     // Component logic here
   };
   </script>
   
   <style scoped>

.bg-image {
  /* The image used */
  background-image: url("https://fastly.picsum.photos/id/622/200/300.jpg?hmac=HR8-4uUEihkyJx4VczHLFhVvELy7KCD1jm16BABaDy8");
  
  /* Add the blur effect */
  

  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 80%;
  padding: 20px;
  text-align: center;
}
</style>
  