// 全ての.like-btnを取得して、各ボタンにイベントリスナーを追加する
const likeBtns = document.querySelectorAll(".like-btn");

likeBtns.forEach(likeBtn => {
    likeBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const clickedEl = e.target;
        clickedEl.classList.toggle("liked");

        const postId = clickedEl.id.replace('like-btn-', '');

        const res = await fetch("/posts/like", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ post_id: postId }),
        });

        const data = await res.json();

        if (res.ok) {
            // いいね数を更新
            clickedEl.nextElementSibling.innerHTML = data.likesCount;
        } else {
            alert('処理が失敗しました。');
        }
    });
});
