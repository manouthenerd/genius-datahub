<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Award, Plus } from 'lucide-vue-next';
import { Badge } from '@/components/ui/badge';
import AvatarGroup from '@/components/AvatarGroup.vue';
import ActionOption from '@/components/ActionOption.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Projets',
        href: '/projects',
    },
];
</script>

<template>

    <Head title="Projets" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min">

                <div class="p-1 space-y-2 border border-slate-200 text-xs rounded shadow bg-amber-100 text-black/90">
                    <p class="flex items-center uppercase font-bold">
                        <Award :size="18" />
                        Important
                    </p>
                    <p class="ml-1 text-[#000000e3]">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas nemo, impedit debitis quaerat ipsa
                        architecto repellendus aliquam quibusdam laudantium iste laborum odio ut. Alias expedita minus
                        nulla veniam voluptate sed, magni dolorum consequatur magnam explicabo, delectus cupiditate
                        dicta illo iure quaerat qui ratione debitis blanditiis asperiores optio quod quas nemo.
                    </p>
                </div>

            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-400 text-xs">Projets en cours</p>
                    <Button variant="ghost">
                        <Plus />
                        Nouveau Projet
                    </Button>
                </div>
                <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <caption
                                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900  dark:text-white dark:bg-gray-800">
                                Our products
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of
                                    Flowbite products designed to help you work and play, stay organized, get answers,
                                    keep in touch, grow your business, and more.</p>
                            </caption>
                            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Titre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tag
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cessionnaires
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Statut
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Priorité
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Site SAPH
                                    </th>
                                    <td class="px-6 py-4">
                                        <Badge>
                                            Vidéosurveillance
                                        </Badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        <AvatarGroup />
                                    </td>
                                    <td class="px-6 py-4">
                                        <Badge class="bg-green-50 text-black" variant="secondary">
                                            <span class="size-[5px] rounded-full bg-green-500"></span> En cours
                                        </Badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        Moyenne
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <ActionOption/>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </AppLayout>
</template>
