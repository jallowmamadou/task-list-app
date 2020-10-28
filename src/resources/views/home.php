<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Todo App</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>

    <!-- Font Awesome if you need it
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    -->
    <link
            rel="stylesheet"
            href="https://unpkg.com/tailwindcss/dist/tailwind.min.css"
    />
    <style>
        #app {
            max-width: 980px;
            margin: 0 auto;
            padding-top: 20px;
        }
    </style>
</head>

<body
        class="font-sans antialiased text-gray-900 leading-normal tracking-wider bg-cover"
>
<div id="app">
    <div class="lg:flex lg:items-center lg:justify-between">
        <div class="flex-1 min-w-0">
            <h2
                    class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate"
            >
                Task List
            </h2>
        </div>
        <div class="mt-5 flex lg:mt-0 lg:ml-4">
          <span class="hidden sm:block shadow-sm rounded-md">
            <button
                    :class="{ 'bg-blue-500': view === 'IN-PROGRESS' }"
                    @click="changeView('IN-PROGRESS')"
                    type="button"
                    class="hover:bg-blue-700 inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 transition duration-150 ease-in-out"
            >
              In-progress
            </button>
          </span>

            <span class="hidden sm:block ml-3 shadow-sm rounded-md">
            <button
                    :class="{ 'bg-blue-500': view === 'PENDING' }"
                    @click="changeView('PENDING')"
                    type="button"
                    class="hover:bg-blue-700 inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
            >
              Pending
            </button>
          </span>

            <span class="sm:ml-3 shadow-sm rounded-md">
            <button
                    :class="{ 'bg-blue-500': view === 'DONE' }"
                    @click="changeView('DONE')"
                    type="button"
                    class="hover:bg-blue-700 inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
            >
              Done
            </button>
          </span>
        </div>
    </div>
    <div style="margin-top: 20px"></div>
    <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" @submit.prevent="saveTask()">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="mt-6">
                                <label
                                        for="title"
                                        class="block text-sm leading-5 font-medium text-gray-700"
                                >
                                    Title
                                </label>
                                <div class="rounded-md shadow-sm">
                                    <input
                                            v-model="form.title"
                                            type="text"
                                            name="title"
                                            class="form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                            placeholder="Title"
                                    />
                                </div>
                            </div>

                            <div class="mt-6">
                                <label
                                        for="description"
                                        class="block text-sm leading-5 font-medium text-gray-700"
                                >
                                    Description
                                </label>
                                <div class="rounded-md shadow-sm">
                      <textarea
                              v-model="form.description"
                              rows="3"
                              class="form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                              placeholder="Task description"
                              name="description"
                      ></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Brief description of your task.
                                </p>
                            </div>
                            <div class="mt-6">
                                <label
                                        for="due_date"
                                        class="block text-sm leading-5 font-medium text-gray-700"
                                >
                                    Due Date
                                </label>
                                <div class="rounded-md shadow-sm">
                                    <input
                                            v-model="form.due_date"
                                            type="date"
                                            name="due_date"
                                            class="form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                            placeholder="Title"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <span class="inline-flex rounded-md shadow-sm">
                    <button
                            class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                    >
                      Save
                    </button>
                  </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="margin-top: 20px"></div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
                <div
                        class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                    <h3>{{view}}</h3>
                    <hr>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Title
                            </th>
                            <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Due Date
                            </th>
                            <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Action
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(task , index) in taskList">
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div
                                                class="text-sm leading-5 font-medium text-gray-900"
                                        >
                                            {{task.title}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{task.due_date?.date || task.due_date || '-'}}
                                </div>
                            </td>

                            <td
                                    class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium"
                            >
                                <button
                                        v-if="task.status === 'IN-PROGRESS'"
                                        type="button"
                                        class="text-indigo-600 hover:text-indigo-900"
                                        @click="changeStatus(index,'DONE')"

                                >
                                    Done
                                </button>
                                <button
                                        v-if="task.status === 'PENDING'"
                                        type="button"
                                        class="text-indigo-600 hover:text-indigo-900"
                                        @click="changeStatus(index,'IN-PROGRESS')"
                                >
                                    Start
                                </button>
                            </td>
                        </tr>

                        <!-- More rows... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script>
    new Vue({
        el: "#app",
        data: {
            view: 'IN-PROGRESS',
            task: "",
            taskList: [],
            form: {
                title: null,
                description: null,
                due_date: null
            }
        },
        methods: {
            saveTask: async function () {
                const response = await fetch("http://localhost:8080/tasks", {
                    method: "POST",
                    mode: "no-cors",
                    headers: {
                        "content-type": "application/json",
                    },
                    body: JSON.stringify({status: "PENDING", ...this.form}),
                }).then((response) => response.json());

                this.taskList = [response, ...this.taskList];

                this.form = {
                    title: null,
                    description: null,
                    due_date: null
                }
            },

            listTask: function (status = 'PENDING') {
                return fetch(`http://localhost:8080/tasks?status=${status}`, {
                    method: "GET",
                    mode: "no-cors",
                    headers: {
                        "content-type": "application/json",
                        Accept: "application/json",
                    },
                }).then((response) => response.json());
            },
            changeStatus: async function (index, type) {
                const task = this.taskList[index];
                this.taskList[index] = await fetch(`http://localhost:8080/tasks/${task.id}`, {
                    method: "POST",
                    mode: "no-cors",
                    headers: {
                        "content-type": "application/json",
                        Accept: "application/json",
                    },
                    body: JSON.stringify({status: type}),
                }).then((response) => response.json())
                window.location.reload();
            },
            changeView: async function (type) {
                this.view = type;
                this.taskList = await this.listTask(type)
            }
        },
        created: async function () {
            this.taskList = await this.listTask(this.view);
        }
    });
</script>
</body>
</html>
