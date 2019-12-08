
/******** index.html charts ********/
// Pi chart
if(document.getElementById("chart-1")) { // Fix t undefined

  new Chart(document.getElementById("chart-1"), {
      type: 'pie',
      data: {
        labels: ["ذكور", "اناث"],
        datasets: [{
          label: "ناخبون",
          backgroundColor: ["#888", "#555"],
          data: [2478,5267]
        }]
      },
      options: {
        legend: { 
          display: false,
          position: 'bottom',
          reverse: true
        },
        title: {
          display: true,
          text: 'الذكور والاناث'
        }
      }
    });
  }
    
    // Bar chart
    if(document.getElementById("chart-2")) {
    new Chart(document.getElementById("chart-2"), {
        type: 'bar',
        data: {
          labels: ["من 20 الي 30", "من 30 الي 40", "من 40 الي 50", "من 50 الي 60", "اكبر من 60"],
          datasets: [
            {
              label: "ناخبون",
              backgroundColor: ["#111", "#333","#555","#777","#999"],
              data: [2478,5267,734,784,433]
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: '  اعمار الناخبون '
          }
        }
    });}
    
    // Pi chart
    if(document.getElementById("chart-3")) {
    new Chart(document.getElementById("chart-3"), {
      type: 'pie',
      data: {
        labels: ["الاولى", "الثانية","الثالثة"],
        datasets: [{
          label: "ناخبون",
          backgroundColor: ["#eee", "#ccc","#ddd"],
          data: [2478,5267,4567]
        }]
      },
      options: {
        legend: { 
          display: false,
          position: 'bottom',
          reverse: true
        },
        title: {
          display: true,
          text: 'حجم الدوائر'
        }
      }
    });}
    
    
    
    // pie chart
    if(document.getElementById("chart-4")){
    new Chart(document.getElementById("chart-4"), {
      type: 'pie',
      data: {
        labels: ["ذكور", "اناث"],
        datasets: [{
          label: "ناخبون",
          backgroundColor: ["#444", "#999"],
          data: [248,527]
        }]
      },
      options: {
        legend: { 
          display: false,
          position: 'bottom',
          reverse: true
        },
        title: {
          display: true,
          text: 'الذكور والاناث'
        }
      }
    });
  }
    // Bar chart
    if(document.getElementById("chart-5")){
    new Chart(document.getElementById("chart-5"), {
      type: 'bar',
      data: {
        labels: ["الثالثة", "الثانية", "الاولى"],
        datasets: [
          {
            label: "ناخبون",
            backgroundColor: ["#111", "#333","#555","#777","#999"],
            data: [7934,7844,4433]
          }
        ]
      },
      options: {
        legend: { display: false },
        title: {
          display: true,
          text: 'قيمة صوت الناخبون'
        }
      }
    }); 
  }
    // Pi chart
    if(document.getElementById("chart-6")){
    new Chart(document.getElementById("chart-6"), {
      type: 'pie',
      data: {
        labels: ["الثانية","الثالثة"],
        datasets: [{
          label: "ناخبون",
          backgroundColor: ["#eee", "#ccc","#ddd"],
          data: [278,567,467]
        }]
      },
      options: {
        legend: { 
          display: false,
          position: 'bottom',
          reverse: true
        },
        title: {
          display: true,
          text: 'حجم الدوائر'
        }
      }
    });
  }
    