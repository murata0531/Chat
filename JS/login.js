<script type="text/javascript">

    let url = new URL(window.location.href);

    alert(url);
    // URLSearchParamsオブジェクトを取得
    let params = url.searchParams;

    const errorMessage = params.get('error');

    params.delete('error');

    alert(params.get('error')); // null
    // アドレスバーのURLからGETパラメータを削除
    history.replaceState('', '', url.pathname);
</script>