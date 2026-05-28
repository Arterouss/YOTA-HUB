<?php
$dirs = ['resources/views/components', 'resources/views/auth'];
foreach($dirs as $d) {
    if(!is_dir($d)) continue;
    $dir = new RecursiveDirectoryIterator($d);
    $ite = new RecursiveIteratorIterator($dir);

    foreach($ite as $file) {
        if(pathinfo($file, PATHINFO_EXTENSION) == 'php') {
            $c = file_get_contents($file);
            $c = preg_replace('/(?<!dark:)bg-white\b(?!.*dark:bg-)/', 'bg-white dark:bg-slate-800', $c);
            $c = preg_replace('/(?<!dark:)bg-slate-50\b(?!.*dark:bg-)/', 'bg-slate-50 dark:bg-slate-900', $c);
            $c = preg_replace('/(?<!dark:)bg-slate-100\b(?!.*dark:bg-)/', 'bg-slate-100 dark:bg-slate-800', $c);
            
            $c = preg_replace('/(?<!dark:)text-slate-900\b(?!.*dark:text-)/', 'text-slate-900 dark:text-white', $c);
            $c = preg_replace('/(?<!dark:)text-gray-900\b(?!.*dark:text-)/', 'text-gray-900 dark:text-white', $c);
            $c = preg_replace('/(?<!dark:)text-slate-600\b(?!.*dark:text-)/', 'text-slate-600 dark:text-slate-400', $c);
            $c = preg_replace('/(?<!dark:)text-slate-500\b(?!.*dark:text-)/', 'text-slate-500 dark:text-slate-400', $c);
            $c = preg_replace('/(?<!dark:)text-gray-600\b(?!.*dark:text-)/', 'text-gray-600 dark:text-gray-400', $c);
            $c = preg_replace('/(?<!dark:)text-gray-500\b(?!.*dark:text-)/', 'text-gray-500 dark:text-gray-400', $c);
            
            $c = preg_replace('/(?<!dark:)border-slate-100\b(?!.*dark:border-)/', 'border-slate-100 dark:border-slate-700', $c);
            $c = preg_replace('/(?<!dark:)border-slate-200\b(?!.*dark:border-)/', 'border-slate-200 dark:border-slate-700', $c);
            $c = preg_replace('/(?<!dark:)border-gray-100\b(?!.*dark:border-)/', 'border-gray-100 dark:border-gray-700', $c);
            $c = preg_replace('/(?<!dark:)border-gray-200\b(?!.*dark:border-)/', 'border-gray-200 dark:border-gray-700', $c);
            
            file_put_contents($file, $c);
        }
    }
}
echo "Done replacing dark mode classes for components and auth.";
