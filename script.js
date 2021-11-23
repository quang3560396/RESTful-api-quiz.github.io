
const cautraloi = document.querySelectorAll('.cautraloi');
const submitBtn = document.getElementById('submit');
const quiz = document.getElementById('question');
let cauhoihientai = 0;
let socaudung = 0;
let diem = 0;

load_cauhoi();

function load_cauhoi(){
  submitBtn.disabled = true;
  remove_answer();
  
  fetch('http://localhost/php_api/api/question/read.php')
  .then(res => res.json())
  .then(data => {
    // console.log(data);
  document.getElementById('tongsocauhoi').value = data.question.length;
  const cauhoi = document.getElementById('title');

  const cautraloi_a = document.getElementById('cautraloi_a');
  const cautraloi_b = document.getElementById('cautraloi_b');
  const cautraloi_c = document.getElementById('cautraloi_c');
  const cautraloi_d = document.getElementById('cautraloi_d');

    // hiện thị câu hỏi và câu trả lời
    const get_cauhoi = data.question[cauhoihientai];
    // console.log(get_cauhoi);

    cauhoi.innerText = get_cauhoi.title;
    cautraloi_a.innerText = get_cauhoi.cau_a;
    cautraloi_b.innerText = get_cauhoi.cau_b;
    cautraloi_c.innerText = get_cauhoi.cau_c;
    if(get_cauhoi.cau_d != ""){
      cautraloi_d.innerHTML = get_cauhoi.cau_d;
      document.getElementById('mask').classList.remove('hide');

    }else{
      document.getElementById('mask').classList.add('hide');
    }
    document.getElementById('caudung').value = get_cauhoi.cau_dung;
  })
  .catch(error=> console.log(error));
}

//get answer
function get_answer(){
  let answer = undefined;
  cautraloi.forEach((cautraloi) => {
    if (cautraloi.checked) {
      answer = cautraloi.id;
    }
  })
  return answer;
}

// remove answer
function remove_answer(){
  cautraloi.forEach((answer)=>{
    answer.checked = false;
  })
}

// check to next question
cautraloi.forEach((elem) => {
  elem.addEventListener("change",function(event){
    submitBtn.removeAttribute("disabled");
  });
});

// sự kiện click submit
submitBtn.addEventListener("click",()=>{
  const answer = get_answer();
  // console.log(answer);
  if (answer) {
    if (answer === document.getElementById('caudung').value) {
      socaudung++;
      diem++;
    }
  }
  cauhoihientai ++;
  load_cauhoi();
  
  if(cauhoihientai<document.getElementById('tongsocauhoi').value){
    load_cauhoi();
  }else{
    const tongsocauhoi = document.getElementById('tongsocauhoi').value;
    quiz.innerHTML = `
      <h2>Bạn đã đúng ${socaudung}/${tongsocauhoi} câu hỏi.</h2>
      <p>Số điểm đạt được là: ${diem}</p>
      <button onclick="location.reload()">Làm lại bài</button>
    `

  }
})