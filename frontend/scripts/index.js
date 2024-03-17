const form = $('#form');
const newsContainer = $('#new-container');
const title = $('#title');
const content = $('#content');
let news = [];

const getNews = () => {
  const url = 'http://localhost/News-Website/backend/read.php';

  axios
    .get(url)
    .then((response) => {
      news = response.data;
      renderNews(response.data['news']);
    })
    .catch((error) => {
      console.error('Error fetching news:', error);
    });
};

const createNew = () => {
  const url = 'http://localhost/News-Website/backend/create.php';

  const formData = new FormData();

  formData.append('title', title.val());
  formData.append('content', content.val());

  axios
    .post(url, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })
    .then((response) => {
      console.log(response.data);
      getNews();
    })
    .catch((error) => {
      console.error('Error creating news:', error);
    });
};

const report = ({ title, content, published_date }) => `
  <h2 class="title">${title}</h2>
  <p class="content">${content}</p>
  <span class="published-date">${published_date}</span>
  <hr />`;

const renderNews = (arr) => {
  console.log(arr);
  newsContainer.empty();

  arr.forEach((n) => {
    newsContainer.append(report(n));
  });
};

getNews();

form.on('submit', function (e) {
  e.preventDefault();
  createNew();
});
