<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <!-- TODO Faire passer les avatars en dessous du thead -->
        <thead
            class="text-xs bg-blue-950 sticky top-0 sticky-top   text-white uppercase dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nom
                </th>
                <th scope="col" class="px-6 py-3">
                    Service
                </th>
                <th scope="col" class="px-6 py-3">
                    Taille
                </th>
                <th scope="col" class="px-6 py-3">
                    Modifié le
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-y transition-all dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row"
                    class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center gap-1 cursor-pointer">
                    <Folder :size="16" fill="#FFD700" /> <span>projet-coopewo</span>
                </th>
                <td class="px-6 py-2">
                    Service communication
                </td>
                <td class="px-6 py-2">
                    23.3 Mo
                </td>
                <td class="px-6 py-2">
                    01/09/2025
                </td>
                <td class="px-6 py-2 text-right">
                    <Ellipsis />
                </td>
            </tr>

        </tbody>
    </table>
</template>

<script setup lang="ts">

import {Folder, Ellipsis } from 'lucide-vue-next';

</script>