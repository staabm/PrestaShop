const faker = require('faker');

/**
 * Create new cms category to use on creation cms category form on BO
 * @class
 */
class CMSCategoryData {
  /**
   * Constructor for class CMSCategoryData
   * @param categoryToCreate {Object} Could be used to force the value of some members
   */
  constructor(categoryToCreate = {}) {
    /** @member {string} Name of the page category */
    this.name = categoryToCreate.name || faker.commerce.department();

    /** @member {boolean} True to display the category on FO */
    this.displayed = categoryToCreate.displayed === undefined ? true : categoryToCreate.displayed;

    /** @member {string} Description of the category */
    this.description = faker.lorem.sentence();

    /** @member {string} Meta title of the category */
    this.metaTitle = categoryToCreate.metaTitle || faker.name.title();

    /** @member {string} Meta description of the category */
    this.metaDescription = faker.lorem.sentence();

    /** @member {string} Meta keyword of the category */
    this.metaKeywords = faker.commerce.department();
  }
}

module.exports = CMSCategoryData;
