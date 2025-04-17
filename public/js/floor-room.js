document.addEventListener('DOMContentLoaded', function () {
  // Get room name from the page
  const roomName = document.querySelector('.text-3xl').textContent.trim();
  
  // Set tanggal default ke hari ini
  const today = new Date();
  const yyyy = today.getFullYear();
  let mm = today.getMonth() + 1; // Months start at 0!
  let dd = today.getDate();

  if (dd < 10) dd = '0' + dd;
  if (mm < 10) mm = '0' + mm;

  const formattedToday = yyyy + '-' + mm + '-' + dd;
  document.getElementById('booking-date').value = formattedToday;

  // Get booked dates from a data attribute in HTML
  // In your Blade template, add: data-booked-dates="{{ json_encode($bookedDates) }}"
  // to an element like the calendar container
  let bookedDatesRaw = [];
  const calendarElement = document.getElementById('calendarGrid');
  if (calendarElement && calendarElement.dataset.bookedDates) {
    try {
      bookedDatesRaw = JSON.parse(calendarElement.dataset.bookedDates);
    } catch (e) {
      console.error('Error parsing booked dates:', e);
    }
  }

  let bookedDatesMap = {}; // We'll organize booked dates by year-month for easier lookup

  // Process the booked dates into a map for efficient lookup
  bookedDatesRaw.forEach(dateStr => {
    const date = new Date(dateStr);
    const year = date.getFullYear();
    const month = date.getMonth();
    const day = date.getDate();
    
    // Create year-month key
    const yearMonthKey = `${year}-${month}`;
    
    if (!bookedDatesMap[yearMonthKey]) {
      bookedDatesMap[yearMonthKey] = [];
    }
    
    bookedDatesMap[yearMonthKey].push(day);
  });

  // Validasi tanggal agar tidak bisa memilih tanggal yang sudah lewat
  document.getElementById('booking-date').addEventListener('change', function () {
    const selectedDate = new Date(this.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    if (selectedDate < today) {
      alert('Tidak dapat memilih tanggal yang sudah lewat.');
      this.value = formattedToday;
      return;
    }

    // Check if the selected date is already booked
    const selectedYear = selectedDate.getFullYear();
    const selectedMonth = selectedDate.getMonth();
    const selectedDay = selectedDate.getDate();
    const yearMonthKey = `${selectedYear}-${selectedMonth}`;
    
    if (bookedDatesMap[yearMonthKey] && bookedDatesMap[yearMonthKey].includes(selectedDay)) {
      alert(`Untuk ${roomName} Tanggal ini sudah di-booking. Silakan pilih tanggal atau ruangan lain.`);
      this.value = formattedToday;
    }
  });

  // Tombol konfirmasi booking
  document.getElementById('confirm-booking').addEventListener('click', function (e) {
    const bookingName = document.getElementById('booking-name').value;
    const bookingDate = document.getElementById('booking-date').value;
    const bookingNeeds = document.getElementById('booking-needs').value;

    // Validasi form sebelum submit
    if (!bookingName || !bookingDate || !bookingNeeds) {
      e.preventDefault(); // Prevent form submission
      alert('Mohon lengkapi semua field.');
      return;
    }

    // Check if the selected date is already booked
    const selectedDate = new Date(bookingDate);
    const selectedYear = selectedDate.getFullYear();
    const selectedMonth = selectedDate.getMonth();
    const selectedDay = selectedDate.getDate();
    const yearMonthKey = `${selectedYear}-${selectedMonth}`;
    
    if (bookedDatesMap[yearMonthKey] && bookedDatesMap[yearMonthKey].includes(selectedDay)) {
      e.preventDefault(); // Prevent form submission
      alert(`Untuk ${roomName} Tanggal ini sudah di-booking. Silakan pilih tanggal atau ruangan lain.`);
      return;
    }
  });

  // Fungsi untuk memformat tanggal ke format Indonesia
  function formatDate(dateString) {
    const months = [
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    const date = new Date(dateString);
    const day = date.getDate();
    const month = months[date.getMonth()];
    const year = date.getFullYear();

    return `${day} ${month} ${year}`;
  }

  // Calendar visualization
  const monthYearDisplay = document.getElementById('monthYearDisplay');
  const calendarGrid = document.getElementById('calendarGrid');
  const prevMonthBtn = document.getElementById('prevMonth');
  const nextMonthBtn = document.getElementById('nextMonth');
    
  // Tanggal saat ini
  let currentDate = new Date();
    
  // Array nama bulan
  const monthNames = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
    
  // Fungsi untuk mendapatkan jumlah hari dalam bulan
  function getDaysInMonth(year, month) {
    return new Date(year, month + 1, 0).getDate();
  }
    
  // Fungsi untuk mendapatkan hari pertama dalam bulan (0 = Minggu, 1 = Senin, dst)
  function getFirstDayOfMonth(year, month) {
    return new Date(year, month, 1).getDay();
  }
    
  // Fungsi untuk mengupdate display kalender
  function updateCalendar() {
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();
    
    // Update judul bulan dan tahun
    monthYearDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    
    // Kosongkan grid kalender
    calendarGrid.innerHTML = '';
    
    // Mendapatkan jumlah hari dan hari pertama dari bulan
    const daysInMonth = getDaysInMonth(currentYear, currentMonth);
    const firstDayOfMonth = getFirstDayOfMonth(currentYear, currentMonth);
    
    // Menambahkan cell kosong untuk hari-hari sebelum tanggal 1
    for (let i = 0; i < firstDayOfMonth; i++) {
      const emptyDay = document.createElement('div');
      emptyDay.className = 'calendar-day empty';
      calendarGrid.appendChild(emptyDay);
    }
    
    // Mendapatkan tanggal hari ini untuk perbandingan
    const today = new Date();
    const isCurrentMonth = today.getMonth() === currentMonth && today.getFullYear() === currentYear;
    const todayDate = today.getDate();
    
    // Get the booked dates for the current month
    const yearMonthKey = `${currentYear}-${currentMonth}`;
    const currentMonthBookedDates = bookedDatesMap[yearMonthKey] || [];
    
    // Menambahkan tanggal-tanggal dalam bulan
    for (let day = 1; day <= daysInMonth; day++) {
      const dayElement = document.createElement('div');
      dayElement.textContent = day;
      dayElement.className = 'calendar-day';
      
      // Cek apakah tanggal ini adalah hari ini
      if (isCurrentMonth && day === todayDate) {
        dayElement.classList.add('today');
      }
      // Cek apakah tanggal ini sudah dibooking
      else if (currentMonthBookedDates.includes(day)) {
        dayElement.classList.add('booked');
      }
      
      // Add click event for selecting a date
      dayElement.addEventListener('click', function() {
        // Don't allow selecting booked dates
        if (currentMonthBookedDates.includes(day)) {
          alert(`Untuk ${roomName} Tanggal ini sudah di-booking. Silakan pilih tanggal atau ruangan lain.`);
          return;
        }
        
        // Don't allow selecting past dates
        const clickedDate = new Date(currentYear, currentMonth, day);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (clickedDate < today) {
          alert('Tidak dapat memilih tanggal yang sudah lewat.');
          return;
        }
        
        // Set the date in the booking form
        let mm = currentMonth + 1;
        if (mm < 10) mm = '0' + mm;
        let dd = day;
        if (dd < 10) dd = '0' + dd;
        
        document.getElementById('booking-date').value = `${currentYear}-${mm}-${dd}`;
      });
      
      calendarGrid.appendChild(dayElement);
    }
  }
    
  // Event listener untuk tombol bulan sebelumnya
  prevMonthBtn.addEventListener('click', function() {
    currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
    updateCalendar();
  });
    
  // Event listener untuk tombol bulan berikutnya
  nextMonthBtn.addEventListener('click', function() {
    currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
    updateCalendar();
  });
    
  // Inisialisasi kalender
  updateCalendar();
});