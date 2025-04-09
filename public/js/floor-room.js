document.addEventListener('DOMContentLoaded', function () {
  // Set tanggal default ke hari ini
  const today = new Date();
  const yyyy = today.getFullYear();
  let mm = today.getMonth() + 1; // Months start at 0!
  let dd = today.getDate();

  if (dd < 10) dd = '0' + dd;
  if (mm < 10) mm = '0' + mm;

  const formattedToday = yyyy + '-' + mm + '-' + dd;
  document.getElementById('booking-date').value = formattedToday;

  // Validasi tanggal agar tidak bisa memilih tanggal yang sudah lewat
  document.getElementById('booking-date').addEventListener('change', function () {
      const selectedDate = new Date(this.value);
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      if (selectedDate < today) {
          alert('Tidak dapat memilih tanggal yang sudah lewat.');
          this.value = formattedToday;
      }
  });

  // Tombol konfirmasi booking
  document.getElementById('confirm-booking').addEventListener('click', function () {
      const bookingName = document.getElementById('booking-name').value;
      const bookingDate = document.getElementById('booking-date').value;
      const bookingNeeds = document.getElementById('booking-needs').value;

      // Validasi form sebelum submit
      if (!bookingName || !bookingDate || !bookingNeeds) {
          alert('Mohon lengkapi semua field.');
          return;
      }

      // Format tanggal untuk ditampilkan
      const formattedDate = formatDate(bookingDate);

      // Di sini Anda bisa menambahkan kode untuk mengirim data ke server
      // atau menampilkan konfirmasi booking
      alert(
          `Booking berhasil!\n\nNama: ${bookingName}\nTanggal: ${formattedDate}\nKebutuhan: ${bookingNeeds}`
      );

      // Kode untuk mengirim data ke server bisa ditambahkan di sini
      // fetch('/api/booking', {
      //     method: 'POST',
      //     headers: {
      //         'Content-Type': 'application/json',
      //     },
      //     body: JSON.stringify({
      //         name: bookingName,
      //         date: bookingDate,
      //         needs: bookingNeeds
      //     }),
      // })
      // .then(response => response.json())
      // .then(data => {
      //     console.log('Success:', data);
      // })
      // .catch((error) => {
      //     console.error('Error:', error);
      // });
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

  // Kode calendar tetap dipertahankan
  const monthYearDisplay = document.getElementById('monthYearDisplay');
  const calendarGrid = document.getElementById('calendarGrid');
  const prevMonthBtn = document.getElementById('prevMonth');
  const nextMonthBtn = document.getElementById('nextMonth');
    
  // Tanggal saat ini
  let currentDate = new Date();
    
  // Contoh tanggal yang sudah dibooking (untuk visualisasi saja)
  const bookedDates = [5, 10, 15, 20, 25];
    
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
      else if (bookedDates.includes(day)) {
        dayElement.classList.add('booked');
      }
      
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