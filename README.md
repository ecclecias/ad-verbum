# Ad Verbum

O Ad Verbum é um plugin que facilita a integração da Bíblia em seu site WordPress. Crie traduções, navegue por diferentes versões e exiba versículos e passagens com facilidade.

#### Funcionalidades

- Crie traduções da Bíblia (_NVI, ACF, AA ou outras_) como Post Type Bible.
- Repositório com algumas traduções: https://github.com/thiagobodruk/biblia
- Exiba o "Bible Navigator" em qualquer página usando o shortcode.

#### Começando

1. Instale e ative o plugin Ad Verbum.
2. Crie posts do tipo "Bible" para cada tradução.
3. Copie o conteúdo JSON das traduções desejadas para o campo "Tradução".
4. Utilize o shortcode para exibir o "Bible Navigator" em qualquer página.
5. Use a single-page do Post Type Bible; Nessa tela todas as traduções cadastradas são exibidas.


#### Shortcode

Se você deseja exibir o Bible Navigator em qualquer outro lugar pode usar também o Shortcode:

```
[ad_verbum_shortcode translation="{sigla}"][/ad_verbum_shortcode]
```

Onde você deve substituir o `{sigla}` para a sigla do Post Type Bible criado.
