function toast(Head,Message,Type) {
  if(Type == 'success'){
  $.toast({
      heading: Head,
      text: Message,
      position: 'top-left',
      loaderBg: '#1b4114',
      icon: 'success',
      hideAfter: 3500,
      stack: 6
  });
} else if(Type == 'error') {
    $.toast({
        heading: Head,
        text: Message,
        position: 'top-left',
        loaderBg: '#411414',
        icon: 'error',
        hideAfter: 3500,
        stack: 6
    });
}else{
  $.toast({
      heading: Head,
      text: Message,
      position: 'top-left',
      loaderBg: '#143841',
      icon: 'info',
      hideAfter: 3500,
      stack: 6
  });
}
}