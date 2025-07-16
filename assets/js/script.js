function toggleAnswer(element) {
    const answerContent = element.parentElement.querySelector('.answer-content');
    const detailLink = element;
    
    if (answerContent.style.display === 'none') {
        answerContent.style.display = 'block';
        detailLink.classList.add('active');
    } else {
        answerContent.style.display = 'none';
        detailLink.classList.remove('active');
    }
}

function showNewQuestions() {
    document.querySelector('.header-right').classList.remove('active');
    document.querySelector('.header-left').classList.add('active');
    document.getElementById('home').classList.remove('active');
    document.getElementById('profile').classList.add('active');
}

function showSelectedQuestions() {
    document.querySelector('.header-left').classList.remove('active');
    document.querySelector('.header-right').classList.add('active');
    document.getElementById('profile').classList.remove('active');
    document.getElementById('home').classList.add('active');
} 