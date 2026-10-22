document.querySelector('.menu-toggle')?.addEventListener('click',function(){const el=document.getElementById('nav-items');const open=el.classList.toggle('open');this.setAttribute('aria-expanded',String(open));});
function demoForm(id,messageId,message){const form=document.getElementById(id);if(!form)return;form.addEventListener('submit',e=>{e.preventDefault();document.getElementById(messageId).textContent=message;});}
demoForm('booking-demo','booking-message','Đây là biểu mẫu mô phỏng; yêu cầu chưa được gửi hoặc lưu.');
demoForm('login-demo','login-message','Đây là giao diện mô phỏng; chưa có hệ thống xác thực đăng nhập.');
demoForm('register-demo','register-message','Đây là giao diện mô phỏng; thông tin chưa được lưu và tài khoản chưa được tạo.');
