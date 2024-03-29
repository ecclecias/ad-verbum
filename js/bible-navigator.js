function BibleNavigator() {
    const buttons_books = document.querySelectorAll('.btn-book');
    const buttons_chapters = document.querySelectorAll('.btn-chapter');

    const wrapper_verses = document.querySelectorAll('.verse');

    var marked_verses = [];

    function _listenerEvents() {
        wrapper_verses.forEach(verse => {
            verse.addEventListener("click", () => {
                _toggleElementInArray(marked_verses, verse.id);

                verse.classList.toggle("marked");
            });
        });

        buttons_books.forEach(button => {
            button.addEventListener("click", () => {
                bookAction(button.id);
                chapterAction(button.id + "_1")
            });
        });

        buttons_chapters.forEach(button => {
            button.addEventListener("click", () => {
                chapterAction(button.id);
            });
        });
    }

    function setup() {
        _listenerEvents();

        // Set Gn 1:1 to newbie
        if (window.location.hash == "" && !localStorage.bibleHash) setHash("gn_1");

        const { book, chapter, verse } = splitHash();

        if (book) {
            bookAction(`${book}`);
        }

        if (chapter) {
            chapterAction(`${book}_${chapter}`);
        }

        if (verse) {
            if (verse.includes(".")) {
                verses = verse.split(".");

                verses.forEach(verse => {
                    document.querySelector(`#${book}_${chapter}_${verse}`).classList.add('marked');
                })

                scrollToAnchor(`#${book}_${chapter}_${verses[0]}`);

                return;
            }

            if (verse.includes("-") || verse.includes(":")) {
                verses = verse.includes("-") ? verse.split("-") : verse.split(":");

                for (let v = +verses[0]; v <= +verses[1]; v++) {
                    document.querySelector(`#${book}_${chapter}_${v}`).classList.add('marked')
                }

                scrollToAnchor(`#${book}_${chapter}_${verses[0]}`);

                return;
            }

            scrollToAnchor(`#${book}_${chapter}_${verse}`);
        }
    }

    function bookAction(id) {
        buttons_books.forEach(abbrev => abbrev.classList.remove('active'));

        const current_book = document.querySelector(`#${id}`);
        current_book.classList.add('active');

        document.querySelector('.wrapper-chapters>div:not(.d-none)')?.classList.add('d-none');
        document.querySelector('.wrapper-verses>div:not(.d-none)')?.classList.add('d-none');

        document.querySelector(`.wrapper-chapters .${id}`).classList.remove('d-none');

        const wrapperBooks = document.querySelector('.wrapper-books');
        const yOffset = current_book.getBoundingClientRect().left + window.pageYOffset;

        wrapperBooks.scroll({
            left: yOffset - 20,
            behavior: 'smooth'
        });

        setHash(id);
    }

    function chapterAction(id) {
        buttons_chapters.forEach(abbrev => abbrev.classList.remove('active'));

        const current_chapter = document.querySelector(`#${id}`)
        current_chapter.classList.add('active');

        document.querySelector('.wrapper-verses>div:not(.d-none)')?.classList.add('d-none');
        document.querySelector(`.${id}`).classList.remove('d-none');

        const wrapperChapters = document.querySelector('.wrapper-chapters');
        const yOffset = current_chapter.getBoundingClientRect().left + window.pageYOffset;

        wrapperChapters.scroll({
            left: yOffset - 20,
            behavior: 'smooth'
        });

        scrollToAnchor('.wrapper-verses');

        setHash(id);
    }

    function nextChapter() {
        const { book, chapter } = splitHash();

        next = +chapter + 1;

        let abbrev_next;
        const chapters = document.querySelectorAll(`.btn-chapter.${book}`);

        if (chapters.length >= next) {
            window.location.href = `#${book}_${next}`;
        } else {
            buttons_books.forEach((item, i) => {
                if (item.id.includes(`${book}`)) abbrev_next = buttons_books[i + 1].id;
            });

            next = 1;

            window.location.href = `#${abbrev_next}_${next}`;
            window.location.reload();
        }
    }

    function prevChapter() {
        const { book, chapter } = splitHash();

        next = +chapter - 1;

        let abbrev_next;

        if (next > 0) {
            setHash(`${book}_${next}`);
        } else {
            buttons_books.forEach((item, i) => {
                if (item.id.includes(`${book}`)) {
                    abbrev_next = buttons_books[i - 1].id
                }

                const chapters = document.querySelectorAll(`.btn-chapter.${abbrev_next}`);
                length_next = chapters.length
            });

            window.location.href = `#${abbrev_next}_${length_next}`;
            window.location.reload();
        }
    }

    function scrollToAnchor(elementId) {
        const element = document.querySelector(elementId);

        if (element) {
            const yOffset = element.getBoundingClientRect().top + window.pageYOffset;
            window.scrollTo({
                top: yOffset - 50,
                behavior: "smooth",
            });
        }
    }

    function _toggleElementInArray(array, element) {
        const index = array.indexOf(element);

        if (index === -1) {
            array.push(element);
        } else {
            array.splice(index, 1);
        }
    }

    function setHash(hash) {
        window.location.hash = hash;
        localStorage.bibleHash = hash;
    }

    function splitHash() {
        _hash = localStorage.bibleHash;
        _hash_splitted = _hash.split("_");

        book = _hash_splitted[0];
        chapter = _hash_splitted[1];
        verse = _hash_splitted[2];

        return {
            book,
            chapter,
            verse
        };
    }

    setup();

    return {
        bookAction,
        chapterAction,
        nextChapter,
        prevChapter
    }
}

const Bible = BibleNavigator();