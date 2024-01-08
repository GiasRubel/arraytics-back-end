@extends('layouts.master')

@section('title', 'Create Quiz')

@section('content')
    <style>
        .question-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .options-container {
            margin-top: 10px;
        }

        .option-input-group {
            margin-top: 5px;
        }

        .remove-option,
        .remove-question {
            margin-top: 5px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>

    <h2>Create Quiz</h2>

    <form action="{{ route('quizzes.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="quiz_title">Quiz Title:</label>
            <input type="text" class="form-control" id="quiz_title" name="title" required>
        </div>

        <div id="questions_container">
            <div class="question-section">
                <div class="question">
                    <div class="form-group">
                        <label for="quiz_question_title">Question Title:</label>
                        <input type="text" class="form-control" name="questions[0][quiz_question_title]" required>
                    </div>

                    <div class="form-group">
                        <label for="quiz_question_type">Question Type:</label>
                        <select class="form-control" name="questions[0][quiz_question_type]" required>
                            @foreach($quizTypes as $quizType)
                                <option value="{{ $quizType->id }}">{{ $quizType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="options-container" style="display: none;">
                        <label for="options">Options:</label>
                        <div class="options"></div>
                        <button type="button" class="btn btn-primary mt-2 add_option">Add Option</button>
                    </div>

                    <!-- No Remove Question button initially -->
                </div>
            </div>
        </div>

        <div class="button-container">
            <button type="button" class="btn btn-primary" id="add_question">Add Question</button>
            <button type="submit" class="btn btn-success">Create Quiz</button>
        </div>
    </form>

@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#questions_container').on('change', '.question select[name^="questions["][name$="[quiz_question_type]"]', function() {
                var type = $(this).val();
                var optionsContainer = $(this).closest('.question').find('.options-container');

                if (type === '2' || type === '3') {
                    optionsContainer.show();
                } else {
                    optionsContainer.hide();
                }
            });

            $('#questions_container').on('click', '.remove-question', function() {
                // Only remove if there is more than one question section
                if ($('#questions_container .question-section').length > 1) {
                    $(this).closest('.question-section').remove();
                }
            });

            var questionCounter = 1;

            $('#add_question').on('click', function() {
                var newQuestion = $('#questions_container .question-section:first').clone();
                newQuestion.find('input, select').val('');
                newQuestion.find('.options-container').hide();
                newQuestion.find('.options').empty();

                newQuestion.find('input, select').each(function() {
                    var name = $(this).attr('name').replace('[0]', '[' + questionCounter + ']');
                    $(this).attr('name', name);
                });

                newQuestion.find('.remove-question').remove(); // Remove existing "Remove Question" button

                newQuestion.append('<button type="button" class="btn btn-danger mt-2 remove-question">Remove Question</button>');

                $('#questions_container').append(newQuestion);
                questionCounter++;
            });

            $('#questions_container').on('click', '.add_option', function() {
                var optionInput = '<div class="input-group option-input-group">' +
                    '<input type="text" class="form-control" name="questions[' + (questionCounter - 1) + '][options][]" placeholder="Option" required>' +
                    '<div class="input-group-append">' +
                    '<button type="button" class="btn btn-danger remove-option">Remove</button>' +
                    '</div>' +
                    '</div>';

                $(this).closest('.options-container').find('.options').append(optionInput);
            });

            // Remove dynamically added option
            $('#questions_container').on('click', '.remove-option', function() {
                $(this).closest('.option-input-group').remove();
            });
        });
    </script>
@endpush
